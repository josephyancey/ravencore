#
#                  RavenCore Hosting Control Panel
#                Copyright (C) 2005  Corey Henderson
#
#     This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
#

#

sub checkconf
{
    my ($self, $term) = @_;

    $self->debug("Running checkconf");

    $self->{term} = 0;
    $self->{term} = 1 if $term;

# are we a complete install?
    $self->{install_complete} = 0;
    $self->{install_complete} = 1 if -f $self->{CONF}{RC_ROOT} . '/var/run/install_complete';

# if ENV hostname is empty, fill it
    if( ! $ENV{HOSTNAME} )
    {
	$ENV{HOSTNAME} = `hostname`;
	chomp $ENV{HOSTNAME};
    }

# TODO: remove any stray "SYSTEM_*" files in the var/tmp/sessions/ directory

    my $httpd_path = file_get_contents($self->{CONF}{RC_ROOT} . '/var/run/httpd.path');
    chomp $httpd_path;

    my $httpd_modules_path = file_get_contents($self->{CONF}{RC_ROOT} . '/var/run/httpd_modules.path');
    chomp $httpd_modules_path;

# make sure they both exist
    if( ! -f $httpd_path || ! -d $httpd_modules_path )
    {
# define our directories to search in

        my @httpd_search_dir = file_get_array($self->{CONF}{RC_ROOT} . '/etc/paths.httpd');

        my @httpd_search_bin = ('apache2',
                                'apache',
                                'httpd2',
                                'httpd');

# nested loop to search for the system's httpd binary and modules dir
        foreach my $dir (@httpd_search_dir)
        {
            foreach my $bin (@httpd_search_bin)
            {
# if the given file exsts (eg: /usr/sbin/httpd) then set the HTTPD var to it and exit the nested loop
                if( -f $dir.'/'.$bin )
                {
                    $httpd_path = $dir.'/'.$bin;
                }
            }
# if we match this pattern, this is our modules dir
            my $tmp = `ls $dir/module*/mod_*so 2> /dev/null | head -n 1`;
            if( $tmp )
            {
                $httpd_modules_path = dirname($tmp);
            }
        }

# cache what we found in our var/run/ files
        file_write($self->{CONF}{RC_ROOT} . '/var/run/httpd.path', $httpd_path);
        file_write($self->{CONF}{RC_ROOT} . '/var/run/httpd_modules.path', $httpd_modules_path);

    }

    $self->{CONF}{HTTPD} = $httpd_path;
    $self->{CONF}{HTTPD_MODULES} = $httpd_modules_path;

# TODO: make this be searched for/cached like the above
    $self->{CONF}{INITD} = '/etc/init.d';

# make sure $HTTPD exists
    $self->die_error("Fatal error: unable to find apache binary. If apache is already installed, then we can't find it.")
        if ! defined $self->{CONF}{HTTPD};

# call apache with the -V flag to get it's built-in values. each distro has different defaults,
# and we want to honor those defaults

# TODO: blindly calling open to $httpd_path is a security risk, even if it's a file owned by root...
#       so let's be paranoid and check it for "bad things" anyway.. basically, it should only contain
#       alpha-numeric characters, with the exception of _, -, and /

    $self->debug("Reading compiled in apache server options: " . $self->{CONF}{HTTPD} . " -V");

    open HTTPD, $self->{CONF}{HTTPD} . ' -V |' or $self->die_error("Unable to execute " . $self->{CONF}{HTTPD} . ": " . $!);
    my @httpd_v = <HTTPD>;
    close HTTPD;

    $self->debug("Finished reading");

#
    my $httpd_server_root;
    my $httpd_config_file;
    my $val;

# walk down each line in the output
    foreach (@httpd_v)
    {
# get rid of the return character
        chomp($_);
        $val = $_;

# if the pattern matches, $val won't contain a space
        $val =~ s/^.*HTTPD_ROOT="(.*)"$/\1/;
        $httpd_server_root = $val unless $val =~ m/ /;

        $val = $_;

# likewise here
        $val =~ s/^.*SERVER_CONFIG_FILE="(.*)"$/\1/;
        $httpd_config_file = $val unless $val =~ m/ /;
    }

# look for the path to the apache conf file

    if( -f $httpd_server_root . "/" . $httpd_config_file )
    {

        $httpd_config_file = $httpd_server_root . "/" . $httpd_config_file;
        $self->debug("Found config file at: " . $httpd_config_file);

    }
    elsif( ! -f $httpd_config_file )
    {

# if there is no file existing in $httpd_server_root/$httpd_config_file or $httpd_config_file , then
# we can't look up what user apache will run as

        $self->die_error("Unable to find apache's compiled in configuration file\n" .
                         "HTTPD_ROOT=$httpd_server_root\n" .
                         "SERVER_CONFIG_FILE=$httpd_config_file\n");

    }

# TODO: do this a better way
    $self->{CONF}{httpd_config_file} = $httpd_config_file;

# TODO: search for mime.types elsewhere and make a symlink
# for now, just require that it exists

    if( ! -f "/etc/mime.types" )
    {
        $self->die_error("Fatal error: /etc/mime.types does not exist");
    }

# check to see what version we are now, vs what version we were when we ran last time

    my $run_version = file_get_contents($self->{CONF}{RC_ROOT}.'/var/run/version');
    my $etc_version = file_get_contents($self->{CONF}{RC_ROOT}.'/etc/version');

    my $first_time_run = 0;

# flag that we're starting for the first time after either a fresh install, or an upgrade
    $first_time_run = 1 if $run_version ne $etc_version;

# dependancy checks

    my %deps = $self->module_list;

    foreach my $dep (keys %deps)
    {

# define our conf file
        my $dep_file = $deps{$dep};

# loop thru the dependencies of this module
# if the dependency file doesn't exist, this loop won't happen, and we assume that it's OK that this
# module be enabled

        my @reqs = file_get_array($self->{CONF}{RC_ROOT} . '/etc/dependencies.' . $dep);

        my @cmd_map = file_get_array($self->{CONF}{RC_ROOT} . '/etc/cmd_maps.' . $dep);

# unset our dep_check flags
        my $dep_check_success = 0;
        my $dep_check_failed = 0;

        foreach my $req (@reqs)
        {

            my $cmd = "";

# find the line for the command name/path of this command.. in format: _name=name
            foreach(@cmd_map)
            {
                if(/_$req=/)
                {
                    $cmd = $_;
                    last;
                }
            }

# parse out the _name= part to get the value
            $cmd =~ s/_$req=//;

# make sure it exists when it gets here. if not, we don't have it anyway, so why bother checking
            if($cmd ne "")
            {

# make sure we have the basename of the command of this dependency
                $cmd = basename($cmd);

# walk down our $PATH to see if it exists somewhere. If so, break out of the loop
                foreach my $dir (@{$self->{CONF}{PATH}})
                {
#               print $dir.'/'.$cmd."\n";
                    if( -x $dir.'/'.$cmd )
                    {
                        $dep_check_success = 1;
                    }

                }

            }

# if we didn't succeed in this check, we failed this dependency
            if( $dep_check_success == 0 )
            {
                $dep_check_failed = 1;

# echo out warning if this is the first time we're running after install/upgrade
                if( $first_time_run == 1 )
                {
                    $self->do_error("WARNING: dependancy '" . $req . "' not found for " . $dep . " module.");

                }
            }

        } # end foreach my $req (@reqs)

# toggle our conf file with the executable bit, based on if the module has all its dependencies
        if( $dep_check_failed == 0 )
        {
            chmod 0744, $dep_file;
        }
        else
        {
            chmod 0644, $dep_file;
        }
    } # end foreach my $dep (keys %deps)

# create our shadow object just incase we need to add users/groups

    my $shadow = new rcshadow;
    
# make sure we have the rcadmin user / group
# check the group first, because in order to add the user, we need a valid existing gid
    
    if( ! $shadow->item_exists('group', 'rcadmin') )
    {
	$shadow->add_group('rcadmin');
    }
    
# check to see if the rcadmin user exists
    
    if( ! $shadow->item_exists('user', 'rcadmin') )
    {
	$shadow->add_user('rcadmin','',$self->{CONF}{RC_ROOT},'/bin/false','',$shadow->{group}{'rcadmin'}{'gid'});
    }
    
# make sure the servgrp exists
    
    if( ! $shadow->item_exists('group', 'servgrp') )
    {
	$shadow->add_group('servgrp');
    }
    
# check to see if we're running the first time after a fresh install or upgrade

    if( $first_time_run == 1 )
    {

# we are a different version of ravencore. Remove some things from the var/run/ directory

# only say our version number changed if we actually had a previous version

        if( -f $self->{CONF}{RC_ROOT} . '/var/run/version' )
        {
            $self->do_error("Version number changed since we last ran, running upgrade steps");
        }

# do dependency check

        $self->do_error("Running dependency check....");

        my %deps = $self->module_list;

        foreach my $dep (keys %deps)
        {

            my $dep_file = $deps{$dep};

            if( -x $dep_file )
            {
                $self->do_error($dep . " ok");
            }
            else
            {
                $self->do_error($dep . " failed");

# a failed base configuration check is a fatal error

                if( $dep eq "base" )
                {
                    $self->die_error("base configuration is missing dependencies... see above warnings for details. exiting!");
                }

            }

# sleep for a fraction of a second, so that this loop doesn't blast past the user too fast
            system("sleep .3");
	    
        }

        $self->do_error("Dependency check complete.");

# remove the install_complete so our interface will know to run all the rehash scripts when the conf is complete
# remove the db_install so that we'll run that script
# remove the gpl_check so they can agree to the license, just incase the GPL version number changes
# remove the version so we can copy the new one there

        foreach my $file ( ('install_complete','db_install','gpl_check','version') )
        {
            file_delete($self->{CONF}{RC_ROOT} . '/var/run/' . $file);
        }

# copy the new version to the run cache
        file_copy($self->{CONF}{RC_ROOT} . '/etc/version', $self->{CONF}{RC_ROOT} . '/var/run/version');

# TODO:
# change the runlevel of all the services listed in etc, if they exist
#    $_echo -n "Setting service runlevels...."
#    if [ -x $_chkconfig ]; then
#       for i in `$_cat $RC_ROOT/etc/services.*`; do
#           $_chkconfig --list $i &> /dev/null
# if this service exists in chkconfig
#           if [ $? -eq 0 ]; then
# runlevel with a single chkconfig command, so we'll run 3 of them instead
#               for runlevel in 3 4 5; do
#                   $_chkconfig --level $runlevel $i on &> /dev/null
#               done
#           fi
#       done
#    fi
#    $_echo "done"
#fi

# make sure that ravencore is a listed service
#if [ -x $_chkconfig ]; then
#    $_chkconfig --list ravencore &> /dev/null
#    if [ $? -ne 0 ]; then
# not listed as a service, add it
#        $_chkconfig --add ravencore
# set ravencore to startup on boot. Some distrobutions complain about setting more than one
# runlevel with a single chkconfig command, so we'll run 3 of them instead
#        for runlevel in 3 4 5; do
#           $_chkconfig --level $runlevel ravencore on
#       done
#    fi
#fi

# we need to figure out what user this system is configured to run apache as, so we can add it to servgrp

# first check to see if we already have it cached

        my $httpd_user = file_get_contents($self->{CONF}{RC_ROOT} . '/var/run/httpd_user');

# if it doesn't exist, do some checks for it
        if( $httpd_user eq "" )
        {

# if apache is running, see what users it is running as
# TODO: redo this in perl.....
            my $httpd_bin = $self->{CONF}{HTTPD};
            $httpd_user = `for i in \$(pidof $httpd_bin); do ls -dal /proc/\$i; done | awk '!/root/{print \$3}' | head -n 1`;

# we won't have $httpd_user set if apache isn't running. Try to figure out the user from the conf file

            if( $httpd_user eq "" )
            {

# get the compiled in server root and server config file

                $httpd_config_file;

# find the user from the httpd conf file
                $httpd_user = grep {/^User/} file_get_array($httpd_config_file);
                $httpd_user =~ s/^User //;

# TODO: convert to perl. didn't do this initially because I didn't have time.... and I don't like SuSE Linux!!
# if not found, search the conf files it includes ( ex: SuSE looks in uid.conf )

#        if [ -z "$httpd_user" ]; then
#            for inc in `$_grep '^Include' $httpd_config_file 2> /dev/null`; do
#                httpd_user=$($_grep "^User" $inc | $_awk '{print $2}' 2> /dev/null)
# if we found the user, break out of the loop
#                if [ -n "$httpd_user" ]; then break; fi
#            done
#        fi

# if we still don't have the user, we can't add it to the servgrp, and vhosts won't work

                if( $httpd_user eq "" )
                {
                    $self->die_error("Unable to find the user apache runs as from its configuration file " . $httpd_config_file);
                }

            }

# cache this user to the httpd_user file
            file_write($self->{CONF}{RC_ROOT} . '/var/run/httpd_user', $httpd_user);

        }

# check to make sure if $httpd_user is in servgrp
# get rid of the newline character
        chomp($httpd_user);

        my $httpd_user_check = 0;
        foreach my $usr (@{$shadow->{group}{'servgrp'}{'user_list'}})
        {
            $httpd_user_check = 1 if $usr eq $httpd_user;
        }

# if not, add it
        if( $httpd_user_check == 0 )
        {
            $shadow->group_user_add('servgrp',$httpd_user);
        }

# check to make sure if rcadmin is in servgrp

        my $rcadmin_user_check = 0;
        foreach my $usr (@{$shadow->{group}{'servgrp'}{'user_list'}})
        {
            $rcadmin_user_check = 1 if $usr eq "rcadmin";
        }

# if not, add it
        if( $rcadmin_user_check == 0 )
        {
            $shadow->group_user_add('servgrp','rcadmin');
        }

# check to see if our db_install script ran

        if( ! -f $self->{CONF}{RC_ROOT} . '/var/run/db_install' )
        {
# install the ravencore database
            system($self->{CONF}{RC_ROOT} . '/sbin/db_install');
# check the exit status
            if( $? != 0 )
            {
                $self->die_error("Fatal error: db_install script exited with non-zero status");
            }

        }

    } # end if( $first_time_run == 1 )

# if we made changes to users/groups, commit
    $shadow->commit;

# when we get here, database.cfg exists for sure. read in its contents (if we did this before db_install ran
# for the first time, the file won't exist, therefor we would croak on startup, the very first time we start up)
    $self->read_conf_file($self->{CONF}{RC_ROOT} . "/database.cfg");

# Check if we don't have something in the server-id.conf file

    my $SERVER_ID = file_get_contents($self->{CONF}{RC_ROOT} . '/etc/server-id');

    if( $SERVER_ID eq "" )
    {
        file_write($self->{CONF}{RC_ROOT} . '/etc/server-id', $self->gen_random_id(16));
    }

# check to make sure the session.save_path for php is correct, in case the $RC_ROOT variable changes

    my $php_include = file_get_contents($self->{CONF}{RC_ROOT} . '/var/run/session.include');

    my $include_data = "php_admin_value session.save_path " . $self->{CONF}{RC_ROOT} . "/var/tmp\nphp_admin_value auto_prepend_file " . $self->{CONF}{RC_ROOT}. "/httpdocs/classes/rcclient.php\nphp_admin_value auto_append_file " . $self->{CONF}{RC_ROOT}. "/var/session_close.php\n";

    if( $php_include ne $include_data )
    {
        file_write($self->{CONF}{RC_ROOT} . '/var/run/session.include', $include_data);
        $reload_ravencore = 1;
    }

# make sure the system httpd binary matches what we have running ravencore

    if(file_get_contents($self->{CONF}{HTTPD}) ne file_get_contents($self->{CONF}{RC_ROOT} . '/sbin/ravencore.httpd'))
    {
        file_copy($self->{CONF}{HTTPD}, $self->{CONF}{RC_ROOT} . '/sbin/ravencore.httpd');

        $reload_ravencore = 1;

    }

# check to make sure the vsftpd.conf file is correct
    my $vsftpd_conf;

    $vsftpd_conf = '/etc/vsftpd.conf' if -f '/etc/vsftpd.conf';
    $vsftpd_conf = '/etc/vsftpd/vsftpd.conf' if -f '/etc/vsftpd/vsftpd.conf';

    $self->cache_rebuild_conf_file($dbc, $vsftpd_conf, "vsftpd", "=") if $vsftpd_conf;

# check to make sure the proftpd.conf file is correct
    my $proftpd_conf;

    $proftpd_conf = '/etc/proftpd.conf' if -f '/etc/proftpd.conf';

    if( -f $proftpd_conf && ! -f $vsftpd_conf )
    {
        $self->cache_rebuild_conf_file($dbc, $proftpd_conf, "proftpd", "\t");
    }

# set permissions and ownship of files in the ravencore root

# get rid of the wrapper, if it's still there
    file_delete($self->{CONF}{RC_ROOT} . '/sbin/wrapper', 1);

# start by giving everything root:root
    file_chown_r('root:root', $self->{CONF}{RC_ROOT});
# httpdocs files should be in the rcadmin gruop
    file_chown_r('root:rcadmin', $self->{CONF}{RC_ROOT} . '/httpdocs');

# directory permissions
    chmod 0700, $self->{CONF}{RC_ROOT} . '/conf.d';
    chmod 0700, $self->{CONF}{RC_ROOT} . '/sbin';
    chmod 0700, $self->{CONF}{RC_ROOT} . '/var/lib';
    chmod 0700, $self->{CONF}{RC_ROOT} . '/var/log';
    chmod 0701, $self->{CONF}{RC_ROOT} . '/etc';
    chmod 0701, $self->{CONF}{RC_ROOT} . '/var';
    chmod 0750, $self->{CONF}{RC_ROOT} . '/httpdocs';
    chmod 0751, $self->{CONF}{RC_ROOT} . '/var/apps';
    chmod 0751, $self->{CONF}{RC_ROOT};

# set sbin files to 500
    my @sbin_dir = dir_list($self->{CONF}{RC_ROOT} . '/sbin');

    foreach (@sbin_dir)
    {
        chmod 0500, $self->{CONF}{RC_ROOT} . '/sbin/' . $_;
    }

    file_chown_r('root:servgrp', $self->{CONF}{RC_ROOT} . '/var/apps/squirrelmail');

    file_chown_r('rcadmin:servgrp', $self->{CONF}{RC_ROOT} . '/var/apps/squirrelmail/data');

# tmp files should be owned by rcadmin
    file_chown_r('rcadmin:servgrp', $self->{CONF}{RC_ROOT} . '/var/tmp');
# the tmp dir needs to be in the servgrp group
    file_chown('root:servgrp', $self->{CONF}{RC_ROOT} . '/var/tmp');

# squirrelmail data files need 660 permissions
    file_chmod_r(660, $self->{CONF}{RC_ROOT} . '/var/apps/squirrelmail/data');
    file_chmod_r(660, $self->{CONF}{RC_ROOT} . '/var/tmp');

# some directory permissions
    foreach ('/var/tmp',
             '/var/apps/squirrelmail/data',
             '/var/apps/phpwebftp/tmp')
    {
        chmod 0771, $self->{CONF}{RC_ROOT} . $_;
    }

# make sure all session and run files have root:root 0600 permissions
    foreach ('/var/run',
             '/var/tmp/sessions',
             )
    {
        $self->mkdir_p($self->{CONF}{RC_ROOT} . $_);
        file_chown_r('root:root', $self->{CONF}{RC_ROOT} . $_);
        file_chmod_r(600, $self->{CONF}{RC_ROOT} . $_);
        chmod 0700, $self->{CONF}{RC_ROOT} . $_;
    }

# make sure our database connect info stays safe
    file_chown('root:root', $self->{CONF}{RC_ROOT} . '/.shadow');
    chmod 0600, $self->{CONF}{RC_ROOT} . '/.shadow';
    chmod 0400, $self->{CONF}{RC_ROOT} . '/database.cfg';

# make sure that the vhosts.conf file exists and is readable by rcadmin and apache, but no one else
    file_touch($self->{CONF}{RC_ROOT} . '/etc/vhosts.conf');
    file_chown('root:servgrp', $self->{CONF}{RC_ROOT} . '/etc/vhosts.conf');
    chmod 0440, $self->{CONF}{RC_ROOT} . '/etc/vhosts.conf';

# remove the legacy socket
    file_delete($self->{CONF}{RC_ROOT} . '/db.sock');

# permissions on the socket
    file_chown('root:rcadmin', $self->{CONF}{RC_ROOT} . '/var/rc.sock');
    chmod 0660, $self->{CONF}{RC_ROOT} . '/var/rc.sock';

# if running from the terminal, we don't have a database connection. connect
    $self->database_connect if $self->{term};

# if we have a database connection
    if($self->{db_connected})
    {
	my %dbc = $self->get_db_conf;

# run other checkconf scripts
	$self->checkconf_cron(\%dbc);

# rebuild all the conf files that have been cached for it
	foreach my $conf (keys %{$self->{conf_files_rebuild}})
	{
	    $self->rebuild_conf_file($self->{conf_files_rebuild}{$conf}{dbc},
				     $conf,
				     $self->{conf_files_rebuild}{$conf}{service},
				     $self->{conf_files_rebuild}{$conf}{seperator},
				     $self->{conf_files_rebuild}{$conf}{is_in});
	}
	
# disconnect from the database if we're at the terminal
	if($self->{term})
	{
	    $self->{dbi}->disconnect;
	    $self->{db_connected} = 0;
	    delete $self->{dbi};
	}

    }

# run logrotation if we're not at the terminal
    if($self->{term} == 0)
    {
	$self->rehash_logrotate;
	
	if( -f $self->{CONF}{RC_ROOT} . '/etc/logrotate.conf' )
	{
	    system('logrotate -f ' . $self->{CONF}{RC_ROOT} . '/etc/logrotate.conf &> /dev/null');
	    
# Restart apache
	    system($self->{CONF}{HTTPD} . ' -k graceful');# &> /dev/null');
	}
	
    }

# turn off term, just in-case it's on
    $self->{term} = 0;

} # end sub checkconf

# this is a system check function that is supposed to run once an hour

sub checkconf_cron
{
    my ($self, $dbc) = @_;

    $self->debug("Running other checkconf scripts");

# loop through enabled modules and run checkconf for them
    my %modules = $self->module_list_enabled;

    foreach my $mod (keys %modules)
    {
#        eval
#        {
            my $func = 'checkconf_' . $mod;

            $self->$func($dbc);

            $self->debug("Running $func");
#        };

    }

# TODO: loop through non-enabled modules and run a remove function for them (make the remove functions too)

}

#

sub checkconf_amavisd
{
    my ($self, $dbc) = @_;

# we kind of really need $VMAIL_ROOT to be set to function, so we exit if we don't have it set.

    return if ! $dbc->{VMAIL_ROOT};

# make sure the clamav socket and pid are owned by amavis

    file_chown_r("amavis:amavis", "/var/run/clamav");

# make sure we have our content filter

    my $content_filter_data = "smtp:127.0.0.1:10024";

    if( $content_filter_data ne file_get_contents($self->{CONF}{RC_ROOT} . '/etc/postfix/main.cf/content_filter') )
    {
        file_write($self->{CONF}{RC_ROOT} . '/etc/postfix/main.cf/content_filter', $content_filter_data);
        $self->cache_rebuild_conf_file($dbc, $dbc->{VMAIL_CONF_DIR} . '/main.cf', 'postfix', ' = ');
    }

# do the same for clamd

    $self->cache_rebuild_conf_file($dbc, $dbc->{CLAMD_CONF_FILE}, 'clamd', ' ') if $dbc->{CLAMD_CONF_FILE};

# now manage the amavisd.conf file

    $self->cache_rebuild_conf_file($dbc, $dbc->{AMAVISD_CONF_FILE}, 'amavisd', ' ', 1) if $dbc->{AMAVISD_CONF_FILE};

} # end sub checkconf_amavisd

#

sub checkconf_mail
{
    my ($self, $dbc) = @_;

# we kind of really need $VMAIL_ROOT to be set to function, so we exit if we don't have it
# set.

    return unless $dbc->{VMAIL_ROOT};

# if /usr/libexec doesn't exit, create it ( so postfix will work on SuSE )
# TODO: make this cleaner
    if( ! -d '/usr/libexec' )
    {
        system('ln -s /usr/lib /usr/libexec');
    }

# make sure that whatever postfix is configured to group as, exists
# TODO: make this non-bash if possible
    my $setgid_group = `postconf | grep setgid_group | awk '{print \$3}'`;
    chomp $setgid_group;

    my $shadow = new rcshadow;

    if( $setgid_group && ! $shadow->item_exists('group', $setgid_group) )
    {
        $shadow->add_group($setgid_group);
    }

# The system user mail will run as
    my $VMAIL_USER = 'vmail';

# make sure we have the the vmail user / group
# check the group first, because in order to add the user, we need a valid existing gid

    if( ! $shadow->item_exists('group', $VMAIL_USER) )
    {
        $shadow->add_group($VMAIL_USER);
    }

# check if the user exists

    if( ! $shadow->item_exists('user', $VMAIL_USER) )
    {
        $shadow->add_user($VMAIL_USER,'',$dbc->{VMAIL_CONF_DIR},'/bin/false','',$shadow->{group}{$VMAIL_USER}{'gid'});
    }

# The system uid and gid of the mail user. we put this in the CONF hash so it'll be see in
# the rebuild_conf_file function call
    $self->{CONF}{VMAIL_UID} = $shadow->{user}{$VMAIL_USER}{'uid'};
    $self->{CONF}{VMAIL_GID} = $shadow->{group}{$VMAIL_USER}{'gid'};

# commit any changes to $shadow
    $shadow->commit;

# make sure the /etc/sasldb2 exists and is owned by postfix

    file_touch('/etc/sasldb2');
    file_chown('postfix:postfix', '/etc/sasldb2');
    chmod 0600, '/etc/sasldb2';

# ask dovecot what version it is

    my $dovecot_v = `dovecot --version 2> /dev/null | sed 's/\\..*//'`;
    chomp $dovecot_v;

    my $dot_local;

# copy header_checks
    $dot_local = ".local" if -f $self->{CONF}{RC_ROOT} . '/etc/postfix_header_checks.local';

    file_copy($self->{CONF}{RC_ROOT} . '/etc/postfix_header_checks' . $dot_local, $dbc->{VMAIL_CONF_DIR} . '/header_checks');
    file_touch($dbc->{VMAIL_CONF_DIR} . '/header_checks');

# rebuild configuration files

    $self->cache_rebuild_conf_file($dbc, $dbc->{VMAIL_CONF_DIR} . '/main.cf', 'postfix', ' = ');
    $self->cache_rebuild_conf_file($dbc, $dbc->{VMAIL_CONF_DIR} . '/master.cf', 'postfix', "\t");
    $self->cache_rebuild_conf_file($dbc, "/usr/lib/sasl2/smtpd.conf", 'postfix', ': ');

# dovecot 0.9x rebuilds this way
    $self->cache_rebuild_conf_file($dbc, $dbc->{DOVECOT_CONF_FILE}, 'dovecot', ' = ') if $dovecot_v eq "0";
# for now, use static config file
    $self->cache_rebuild_conf_file($dbc, $dbc->{DOVECOT_CONF_FILE}, 'dovecot', ' = ', 1) if $dovecot_v eq "1";

# make sure "devnull" exists in the aliases file

# figure out the alias database file. It is normally /etc/aliases, but sometimes it is
# something else. We "could" define it in our main.cf, but since we are not generating
# this file completly, just use what the system already has there

    my $alias_database = `postconf 2> /dev/null | grep alias_database | sed 's/:/ /' | awk '{print \$4}' | head -n1`;
    chomp $alias_database;

#

    if( $alias_database ne "" )
    {
        my $devnull = `grep "^devnull:" $alias_database 2> /dev/null`;

#
        if( ! $devnull )
        {
            file_append($alias_database, "devnull:\t/dev/null\n");
# run newaliases so postfix sees the new user
# some systems report info on stdout when ran, force it to /dev/null
            system('newaliases &> /dev/null');

        }

    }

} # end sub checkconf_mail

#

sub checkconf_mrtg
{
    my ($self, $dbc) = @_;

# don't continue if we don't have $MRTG_CONF_FILE
    return if ! $dbc->{MRTG_CONF_FILE};
    return if ! $dbc->{SNMPD_CONF_FILE};

#
    $self->cache_rebuild_conf_file($dbc, $dbc->{SNMPD_CONF_FILE}, 'snmpd', ' = ', 1);

#

    $self->mkdir_p($self->{CONF}{RC_ROOT} . '/var/log/mrtg');

    if( ! -f $dbc->{MRTG_CONF_FILE} . '.orig' )
    {
        file_touch($dbc->{MRTG_CONF_FILE});

        file_copy($dbc->{MRTG_CONF_FILE}, $dbc->{MRTG_CONF_FILE}.'.orig');

        system('cfgmaker ravencore@localhost --global "WorkDir: ' . $self->{CONF}{RC_ROOT} . '/var/log/mrtg" --output ' . $dbc->{MRTG_CONF_FILE});

    }

#

    file_write('/etc/cron.d/mrtg', "*/5 * * * * root LANG=C; /usr/bin/mrtg " . $dbc->{MRTG_CONF_FILE} . " --lock-file " . $self->{CONF}{RC_ROOT} . "/var/run/mrtg.lock --confcache-file " . $self->{CONF}{RC_ROOT} . "/var/run/mrtg.ok");

} # end sub checkconf_mrtg

#

sub checkconf_postgrey
{
    my ($self, $dbc) = @_;

    return if ! $dbc->{VMAIL_ROOT};
    return if ! $dbc->{POSTGREY_SOCKET};

# make sure we have our policy server definition

    my $found = `grep $dbc->{POSTGREY_SOCKET} $self->{CONF}{RC_ROOT}/etc/postfix/main.cf/smtpd_recipient_restrictions 2> /dev/null`;

    if( ! $found )
    {

        my $smtpd_file = file_get_contents($self->{CONF}{RC_ROOT} . '/etc/postfix/main.cf/smtpd_recipient_restrictions');
        chomp $smtpd_file;

        file_write($self->{CONF}{RC_ROOT} . '/etc/postfix/main.cf/smtpd_recipient_restrictions', $smtpd_file . ", check_policy_service " . $dbc->{POSTGREY_SOCKET});

# rebuild the main.cf file
        $self->cache_rebuild_conf_file($dbc, $dbc->{VMAIL_CONF_DIR} . '/main.cf', 'postfix', ' = ');

    }

} # end sub checkconf_postgrey

#
# these functions need to exist, but don't do anything at the moment.
#

sub checkconf_web {}
sub checkconf_base {}
sub checkconf_mysql {}
sub checkconf_dns {}

#

sub cache_rebuild_conf_file
{
    my ($self, $dbc, $conf, $service, $seperator, $is_in) = @_;

    $self->{conf_files_rebuild}{$conf}{dbc} = $dbc;
    $self->{conf_files_rebuild}{$conf}{service} = $service;
    $self->{conf_files_rebuild}{$conf}{seperator} = $seperator;
    $self->{conf_files_rebuild}{$conf}{is_in} = $is_in;
    
}

#

sub rebuild_conf_file
{
    my ($self, $dbc, $conf, $service, $seperator, $is_in) = @_;

    my $conf_basename = basename($conf);
    my $dot_local;
    my $file_data;

#
# TODO: append a header to each conf file, saying that it was created by ravencore
#       on $x date, and that if you wan't to edit it, create a .local file and edit
#       that instead
#

    mkdir_p(dirname($conf));
    file_touch($conf);

    $self->debug("Checking config file: " . $conf);

    if( -f $self->{CONF}{RC_ROOT} . '/etc/' . $conf_basename . '.in' && $is_in )
    {

# .local support for the .in files

        $dot_local = ".local" if -f $self->{CONF}{RC_ROOT} . '/etc/' . $conf_basename . '.in.local';

        my @conf_file_content = file_get_array($self->{CONF}{RC_ROOT} . '/etc/' . $conf_basename . '.in' . $dot_local);

        foreach my $line (@conf_file_content)
        {

            my $tmp = $line;

# code to replace all $_[VAR_NAME] in the files with CONF variables
            if($tmp =~ /\$_\[[_A-Z]*\]/)
            {
                $tmp =~ s/.*\$_\[([_A-Z]*)\].*/\1/;

		my $val = ( $dbc->{$tmp} ? $dbc->{$tmp} : $self->{CONF}{$tmp} );
		$val = ( $val ? $val : $ENV{$tmp} );

                $line =~ s/\$_\[$tmp\]/$val/;
            }

            $file_data .= $line . "\n";

        }

    }
    elsif ( -d $self->{CONF}{RC_ROOT} . '/etc/' . $service . '/' . $conf_basename )
    {

# look in the service config file directory, and get all the files, .local being the preference, and
# using a .local file even if a base file doesn't exist for it

# first we build a list of the distros, to ignore files that end with .dist

        my @dist_list;
        my @dist_file = file_get_array($self->{CONF}{RC_ROOT} . '/etc/dist.map');

        foreach (@dist_file)
        {
            $_ =~ s/ .*//g;
            if($_ && $_ ne "#")
            {
                push @dist_list, $_;
            }
        }

# add ignore and local to the list, because we're not going to look at files
# ending in .local or .ignore either

        push @dist_list, 'ignore';
        push @dist_list, 'local';

# list contents of this directory
        my @dir_contents = dir_list($self->{CONF}{RC_ROOT} . '/etc/' . $service . '/' . $conf_basename);

        foreach my $param_name (@dir_contents)
        {

            my $param_path = $self->{CONF}{RC_ROOT} . '/etc/' . $service . '/' . $conf_basename . '/' . $param_name;

# skip this item if it ends in a .dist, .ignore, or .local
            my $skip = 0;

            foreach (@dist_list)
            {
                $skip = 1 if $param_name =~ /\.$_$/;
	    }
	    
            next if $skip == 1;
	    
# skip this if there is a .ignore file for this directive
            if( ! -f $param_path . '.ignore' )
            {

# check to see if this directive has a customized file for this linux distro
                $param_path .= '.' . $self->{CONF}{dist} if -f $param_path . '.' . $self->{CONF}{dist};

# use the .local file instead, if it exists
                $param_path .= '.local' if -f $param_path . '.local';

# read the file
                my @lines = file_get_array($param_path);

                foreach my $line (@lines)
                {
                    my $tmp = $line;

# code to replace all $_[VAR_NAME] in the files with CONF variables
                    if($tmp =~ /\$_\[[_A-Z]*\]/)
                    {
                        $tmp =~ s/.*\$_\[([_A-Z]*)\].*/\1/;

                        my $val = ( $dbc->{$tmp} ? $dbc->{$tmp} : $self->{CONF}{$tmp} );
			$val = ( $val ? $val : $ENV{$tmp} );

# if we don't have $val at this point, issue an error
			$self->do_error("Warning: $service config file $conf_basename is missing a value for $tmp") unless $val;

# replace the variable with the value
                        $line =~ s/\$_\[$tmp\]/$val/;
                    }

                    $file_data .= $param_name . $seperator . $line . "\n";

                }

            }

        } # end foreach my $param_name (@dir_contents)

    }

#

    if( $file_data ne file_get_contents($conf) )
    {

# if the sys_orig file for the conf file doesn't exist,
        if( ! -f $conf . '.sys_orig' )
        {
# then save the conf file as the sys_orig. This will preserve the system's origonal configuration
# so when we uninstall ravencore, they will be moved back
            file_move($conf, $conf . '.sys_orig');

# tell ravencore that this sys_orig file was made by appending it to our sys_orig list
            file_append($self->{CONF}{RC_ROOT} . '/var/run/sys_orig_conf_files', "$service:$conf\n");

        }

        file_write($conf, $file_data);

        $self->debug("The config file $conf_basename for $service has been modified...rebuilding it and restarting $service");
# if at the terminal, print it out
        if( $self->{term} )
        {
            $self->do_error("The config file $conf_basename for $service has been modified...rebuilding it and restarting $service");
        }

        $self->service($service . " restart");

    }

} # end sub rebuild_conf_file