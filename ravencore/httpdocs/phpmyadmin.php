<?php
/*
                 RavenCore Hosting Control Panel
               Copyright (C) 2005  Corey Henderson

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

include "auth.php";

if (!$did or !$dbid or !$dbu) goto("users.php?uid=$uid");

$sql = "select name, login, passwd from data_bases d, data_base_users u where db_id = d.id and d.id = '$dbid' and u.id = '$dbu' and did = '$did'";
$result = $db->data_query($sql);

$row = $db->data_fetch_array($result);

$lang = $_SESSION['lang'];

$_SESSION = array();

$_SESSION['ravencore_name'] = $row[name];
$_SESSION['ravencore_login'] = $row[login];
$_SESSION['ravencore_passwd'] = $row[passwd];
$_SESSION['ravencore_phpmyadmin_lang'] = $locales[$lang]['phpmyadmin'];

goto("phpmyadmin/");

?>