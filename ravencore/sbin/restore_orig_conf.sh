#!/bin/bash
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

. /etc/ravencore.conf || exit 1

# walk down the list of conf files we've changed since installation, and move them back

for conf in `cat $RC_ROOT/var/run/sys_orig_conf_files 2> /dev/null`; do

	# each line is service:conf_file. we just want the conf file
	conf=$(echo $conf | awk -F : '{print $2}')

	[ -f $conf.sys_orig ] && mv -f $conf.sys_orig $conf

done

