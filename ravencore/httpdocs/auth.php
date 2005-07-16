<?php

// Define our regular expressions. They don't contain ^ or $ in them, because they are used with
// each other in some places. Be sure you supply ^ before the string, and $ after it:
//    eg: preg_match('/^'.REGEX.'$/')
//        preg_match('/^'.REGEX.'@'.REGEX2.'$/')
// to get the full effectiveness of the regular expressions. 

define("REGEX_MAIL_NAME",'([a-zA-Z\d]+((\.||\-||_)[a-zA-Z\d]?)?)*[a-zA-Z\d]');
define("REGEX_DOMAIN_NAME",'([a-zA-Z\d]+((\.||\-)[a-zA-Z\d]?)?)*[a-zA-Z\d]\.[a-zA-Z]+');
define("REGEX_PASSWORD",'[a-zA-Z\d]*');

//Initialize some variables

$js_alerts = array();
$CONF = array();
$conf_not_complete = false;

//A list of variables that are allowed to use the GET and POST methods
$reg_glob_vars = array('uid','did','mid','action','db','dbu','page_type');

foreach($reg_glob_vars as $val) {

  if($_REQUEST[$val]) {

    $eval_code = '$' . $val . ' = $_REQUEST[' . $val . '];';

    eval($eval_code);

  }

}

// Include our function file

include "functions.php";

//Get our conf vars

read_db_conf();

// Check to see if the database conf file exists
if(!file_exists("$CONF[RC_ROOT]/database.cfg")) {

  print 'You are missing the database configuration file: ' . $CONF[RC_ROOT] . '/database.cfg
<p>
Please run the following script as root:
<p>
' . $CONF[RC_ROOT] . '/sbin/database_reconfig';

  exit;

}

// make sure that perl-suidperl works. If it doesn't, it won't run, and "OK" won't be printed.

if(shell_exec("../sbin/wrapper testsuid") != "OK") {

  print 'Your system is unable to suid on perl scripts. This is required for ravencore to function. Please install the perl-suidperl package or recompile perl with suid support';

  exit;

}

// check to see if we have mysql functions

if(!function_exists("mysql_connect")) {

  print 'Unable to call the mysql_connect function. Please install the php-mysql package or recompile PHP with mysql support, and restart the control panel';

  exit;

}

// Connect to the database

$link = mysql_connect($CONF[MYSQL_ADMIN_HOST], $CONF[MYSQL_ADMIN_USER], $CONF[MYSQL_ADMIN_PASS]);

if(!$link) {

  //Print message here

  print 'Unable to get a database connection.';

  exit;

}

//Use the admin database. Default is ravencore

mysql_select_db($CONF[MYSQL_ADMIN_DB], $link) or die(mysql_error());

// read our database configuration settings

read_conf();

// set our some of our php_admin_values that we can't define in the ravencore.httpd.conf
error_reporting(E_ALL ^ E_NOTICE);

//Start the php session. Since the function always returns true, the only time we will
//fail is when we dont have the function. If so, die

session_start() or die("The server doesn't have PHP session functions available.<p>Please recompile PHP with sessions enabled."); 

//Get the ID of this session

$session_id = session_id();

// get our lang based on our session. default to en
// for now, just include lang/en.php
include("lang/en.php");

//If we're trying to login, run the authentication

if($action == "login") {

  // check the lockout to see if we have several failed attempts
  $sql = "select count(*) as count from login_failure where login = '$_POST[user]' and ( ( to_days(date) * 24 * 60 * 60 ) + time_to_sec(date) + '$CONF[LOCKOUT_TIME]' ) > ( ( to_days(now()) * 24 * 60 * 60 ) + time_to_sec(now() ) )";

  $result = mysql_query($sql) or die(mysql_error());

  $row_lock = mysql_fetch_array($result);

  //if we have the same or more as the lockout count, lock the login
  if($row_lock[count] >= $CONF[LOCKOUT_COUNT] and $CONF[LOCKOUT_COUNT]) {

      $login_error = "Login locked";
      
      syslog(LOG_WARNING, "Login attempted for user $_POST[user], but was denied by auto-lock from $_SERVER[REMOTE_ADDR]");

      include("login.php");
      
      exit;

  }
  
  //now we do password authentication

  if($_POST[user] == $CONF[MYSQL_ADMIN_USER]) {
    
    if( $_POST[user] != $CONF[MYSQL_ADMIN_USER] or $_POST[pass] != $CONF[MYSQL_ADMIN_PASS] ) {
      
      // admin login faliure
      
      $sql = "insert into login_failure set date = now(), login = '$_POST[user]'";
      mysql_query($sql);

      $login_error = "Login failure";
      
      syslog(LOG_WARNING, "Login failure for user $_POST[user] from $_SERVER[REMOTE_ADDR]");

      include("login.php");
      
      exit;
      
    }
    
  } else {
    
    //user login auth

    $sql = "select * from users where binary(login) = '$_POST[user]' and binary(passwd) = '$_POST[pass]'";
    $result = mysql_query($sql);
    
    $num = mysql_num_rows($result);
    
    if($num != 1) {

      // email user auth

      list($login_mailname, $login_domain) = split("@",$_POST[user]);

      $sql = "select m.id, d.name, uid, did from mail_users m, domains d where mail_name = '$login_mailname' and name = '$login_domain' and m.passwd = '$_POST[pass]'";
      $result = mysql_query($sql);

      $num = mysql_num_rows($result);

      $row_email_user = mysql_fetch_array($result);

      $mid = $row_email_user[id];
      $uid = $row_email_user[uid];
      $did = $row_email_user[did];

      if($num != 1) {

	$sql = "insert into login_failure set date = now(), login = '$_POST[user]'";
	mysql_query($sql);
	
	$login_error = "Login failure";
	
	syslog(LOG_WARNING, "Login failure for user $_POST[user] from $_SERVER[REMOTE_ADDR]");

	include "login.php";
	
	exit;
      
      }

    }

    // we have this here so the is_admin function still works
    $row_user = mysql_fetch_array($result);
    
  }

  $outdated = 1;

  // look in our misc table to see if we should lock the control panel to users if our version is outdated
  // only bother checking if the configuration is complete
  if($outdated == 1 and !$conf_not_complete) {

    // set the timeout for the tcp connection
    $timeout = 10;

    if ($fsock = @fsockopen('www.ravencore.com', 80, $errno, $errstr, $timeout))
      {
	
	// set the timeout for reading / writting data to the socket
	stream_set_timeout($fsock, $timeout);
	
	$general_version = preg_replace('/\.\d*$/', '.x', $CONF[VERSION]);

	@fputs($fsock, "GET /updates/" . $general_version . ".txt HTTP/1.1\r\n");
	@fputs($fsock, "HOST: www.ravencore.com\r\n");
	@fputs($fsock, "Connection: close\r\n\r\n");

	while (!@feof($fsock)) $data .= @fread($fsock, 1024);

	@fclose($fsock);

	$http_info = explode("\r\n",$data);
	
	//this will always be blank
	//array_pop($http_info);
	$current_version = trim(array_pop($http_info));

	//echo "$general_version -- $current_version -- $CONF[VERSION]";
	
	if($current_version != $CONF[VERSION]) {

	  if(is_admin()) {

	    alert('Control panel is locked for users, because your lock if outdated setting is active, and we appear to be outdated.');

	  } else {

	    $login_error = "Login locked because control panel is outdated.";

	    syslog(LOG_WARNING, "Control panel outdated");

	    include("login.php");

	    exit;

	  }

	}

      }

  }

  // slave server socket_cmd
  if($_POST[socket_cmd]) {

    if($CONF[SERVER_TYPE] == "slave") {

      socket_cmd(urldecode($_POST[socket_cmd]));
      
      syslog(LOG_INFO, "Posted command '$_POST[socket_cmd]' from $_SERVER[REMOTE_ADDR]");
      
      exit;

    } else {

      print 'API command failed. This server is configured as a master server.';

      syslog(LOG_INFO, "API command attempted on master server from $_SERVER[REMOTE_ADDR]");

      exit;

    }

  }

  //

  $sql = "insert into sessions set session_id = '$session_id', login = '$_POST[user]', location = '$_SERVER[REMOTE_ADDR]', created = now(), idle = now()";
  mysql_query($sql);

  syslog(LOG_INFO, "User $_POST[user] logged in from $_SERVER[REMOTE_ADDR]");

  // redirect email users to the edit_mail page

  if($row_email_user) goto("edit_mail.php");

  // send ourself back to where we were upon login
  $url = $_SERVER[PHP_SELF];
  // only add the query string if it exists
  if($_SERVER[QUERY_STRING]) $url .= '?' . $_SERVER[QUERY_STRING];

  // only do a header redirect if we have no pending alerts
  if(!$js_alerts) goto($url);

}

// We can't proceed past this point if we are a slave server
if($CONF[SERVER_TYPE] == "slave") exit;

// Define a default value for SESSION_TIMOUT here, because if we don't have one at all,
// we'll never be able to login

if(!$CONF[SESSION_TIMEOUT]) $session_timeout = 600;
else $session_timeout = $CONF[SESSION_TIMEOUT];

//Delete sessions that have been idle for too long. We must do this before we attempt
//to lookup our session.

$sql = "delete from sessions where ( ( to_days(idle) * 24 * 60 * 60 ) + time_to_sec(idle) + $session_timeout ) < ( ( to_days(now()) * 24 * 60 * 60 ) + time_to_sec(now() ) )";
mysql_query($sql) or die(mysql_error());

$sql = "select * from sessions where binary(session_id) = '$session_id'";
$result = mysql_query($sql);

$num = mysql_num_rows($result);

//we found this user's session

if($num != 0) {

  $row_session = mysql_fetch_array($result);
  
  //make sure the remote addr didn't change
  if($row_session[location] != $_SERVER[REMOTE_ADDR]) {

    syslog(LOG_WARNING, "Session hijack attempt detected for user $row[login] from $_SERVER[REMOTE_ADDR]");
    
    //if it is different, destroy the session
    $sql = "delete from sessions where id = '$row_session[id]'";
    mysql_query($sql);
    
    goto("$PHP_SELF");
    
  }
  
  //If this user is not an admin
  if($row_session[login] != $CONF[MYSQL_ADMIN_USER]) {

    $sql = "select * from users where login = '$row_session[login]'";
    $result = mysql_query($sql);

    $num = mysql_num_rows($result);

    if($num != 0) {

      // we are a control panel user
      
      $row_user = mysql_fetch_array($result);
      
      //It is VERY important that we always set the $uid variable for non admin users
      $uid = $row_user[id];

    } else {

      // we are an email user

      list($login_mailname, $login_domain) = split("@",$row_session[login]);

      $sql = "select m.id, d.name, uid, did from mail_users m, domains d where mail_name = '$login_mailname' and name = '$login_domain'";
      $result = mysql_query($sql);

      $row_email_user = mysql_fetch_array($result);

      // set these values to make sure the user can't change them by messing with the URL
      $mid = $row_email_user[id];
      $uid = $row_email_user[uid];
      $did = $row_email_user[did];

    }

  }
  
  //update your idle
  $sql = "update sessions set idle = now() where id = '$row_session[id]'";
  mysql_query($sql);
  
} else {

  //No session found.
  
  include "login.php";
  
  exit;
  
}

// make sure the admin password doesn't stay as "ravencore"

if($CONF[MYSQL_ADMIN_PASS] == "ravencore" and
   $row_session[login] == $CONF[MYSQL_ADMIN_USER] and
   $_SERVER[PHP_SELF] != "/change_password.php" and
   $_SERVER[PHP_SELF] != "/logout.php") {

  // tell the change_password file that it is being included, rather than called from the browser directly
  $being_included = true;

  include("change_password.php");

  exit;

}

// make the user agrees to the GNU GPL license for using RavenCore
// just in case the gpl_check file gets removed, you can still logout

if(!file_exists("../var/run/gpl_check") and is_admin() and $_SERVER[PHP_SELF] != "/logout.php") {

  if($action == "gpl_agree" and $_POST[gpl_agree]) {

    shell_exec("touch ../var/run/gpl_check");

  } else {

    nav_top();
    
    if($action == "gpl_agree") print '<b><font color="red">You must agree to the GPL License to use RavenCore</font></b><p>';
    
    print 'Please read the GPL License and select the "I agree" checkbox below<hr><pre>';

    $h = fopen("../LICENSE","r");
    
    fpassthru($h);
    
    print 'The GPL License should appear in the frame below:</pre>
<iframe src="GPL" width=675 height=250>
</iframe>
<p>
<form method=post> <input type=checkbox name=gpl_agree value=yes> I agree to these terms and conditions

<p>
<input type=submit value=Submit> <input type=hidden name=action value=gpl_agree></form>';

    nav_bottom();

    exit;

  }

}

// check to make sure we have a complete database configuration. If not, prompt the admin
// user to update it, and lock out the rest of the users

if($conf_not_complete and $_SERVER[PHP_SELF] != "/change_password.php" and $_SERVER[PHP_SELF] != "/logout.php") {

  if(is_admin()) {

    if($action != "update_conf") nav_top();

    // if we have $action, that means we're being posted to. Don't print anything

    if($action != "update_conf") print '<div align=center>' . $lang['welcome_and_thank_you'] . '</div>
<p>
' . $lang['please_upgrade_config'] . '
<div align=center>
<form method=post>
<input type=hidden name=action value="update_conf">
<table>';
    
    $data = "";

    $handle = popen("ls -1 ../conf.d","r");

    while( !feof($handle) ) $data .= fread($handle, 1024);

    pclose($handle);

    // Seperate the data line by line

    $conf_files = explode("\n", $data);

    foreach($conf_files as $conf_file) {
      
      if(!$conf_file) continue;

      // reset whether we have printed this conf file's name yet
      $printed_header = false;

      $conf_data = "";

      $handle = fopen("../conf.d/$conf_file","r");
      
      while( !feof($handle) ) $conf_data .= fread($handle, 1024);
      
      fclose($handle);
      
      // Seperate the data line by line
      
      $conf_array = explode("\n", $conf_data);
      
      foreach($conf_array as $line) {

	// Get rid of quotation marks
	
	$line = ereg_replace("\"", "", $line);
	$line = ereg_replace("\'", "", $line);
	
	// If this looks like a bash shell variable, make it into a php variable. All conf
	// variables will be all upper case. If they are not, they won't get read in here.
	
	if(preg_match("/^[A-Z||_]*=/", $line)) {
	  
	  // the name of the variable
	  
	  $var_name = ereg_replace("=.*", "", $line);
	  
	  // the shipped default of the variable
	  
	  $var_value = ereg_replace(".*=", "", $line);
	  
	  // check to make sure we have this variable

	  if(!$CONF[$var_name] and $action != "update_conf") {

	    // only print "conf configuration" if we are not posting variables, and if we haven't printed
	    // something of this category yet

	    if($action != "update_conf" and !$printed_header) {
	      
	      print '<tr><th colspan=2 align=center>' . ereg_replace('\.conf$',"",$conf_file) . ' configuration</th></tr>';

	      $printed_header = true;

	    }
	    
	    print '<tr><td>' . $var_name . ':</td><td> <input name="' . $var_name . '" value="' . $var_value . '"></td></tr>';
	    
	  }

	  if(($_POST[$var_name]) and $action == "update_conf") {

	    // insert this into the database
	    $sql = "insert into settings set setting = '$var_name', value = '" . $_POST[$var_name] . "'";
	    mysql_query($sql);

	  }
	  
	}
	
      }
      
    }

    if($action != "update_conf") {

      print '<tr><td colspan=2 align=right><input type="submit" value="Submit"></td></tr></table></div>';
    
      nav_bottom();
  
      exit;

    } else {

      $url = $_SERVER[PHP_SELF];

      if($_SERVER[QUERY_STRING]) $url .= '?' . $_SERVER[QUERY_STRING];

      goto($url);

    }

  } else {

    $login_error = "Control Panel is being upgraded. Login Locked.";

    include "login.php";

    exit;
  
  }

}



//NOTE! Anything beyond this point is considered a logged in user

//If we have a $did and no $uid, we're an admin looking at a user's domain page. Get the $uid

if(!$uid and $did) {

  $sql = "select uid from domains where id = '$did'";
  $result = mysql_query($sql);

  $row = mysql_fetch_array($result);

  $uid = $row[uid];

}

// make sure email users only access email user allowed pages

if($row_email_user and !$email_user_page) {

  goto("/edit_mail.php");

}

//If we have a $did, match it with the given $uid. If we fail, goto the user's main page

if($did and !user_have_domain($uid, $did) and !$row_email_user) goto("users.php?uid=$uid");

if($did) $domain_name = get_domain_name($did);

?>
