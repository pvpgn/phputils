
                     Player vs. Player Gaming Network
                         Server Status PHP Script v0.4
             ---------------------------------------------

This is for any of you PvPGN server admins out there who want to display
your server status on your website.

online-offline.php
   Pings a PvPGN server and (optionally) Diablo 2 gameserver to see if they
   are online and then displays the server status on a website.

status.php
  Parses the server.dat file where PvPGN outputs info about users,
  games and channels online, and displays this information on a website.


-----
Usage
-----

To use either of these scripts, simply include it into the page like:
<?php include('status.php'); ?>

or if you want to show both (and this is the recommended way):

<?php
include('online-offline.php');
if ($pvpgn_online) {
    include('status.php');
}
?>

You will also need to set the config options at the beginning of each file.

-------
Licence
-------

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License (GPL)
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

To read the license please visit http://www.gnu.org/copyleft/gpl.html

------------
Contact info
------------

Email:
mark@darkterrorsdomain.cjb.net

IRC:
Server: irc.freenode.net
Channel: #pvpgn
Nick: U-238
