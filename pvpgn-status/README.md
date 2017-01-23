PvPGN Server Status PHP Script
====

![](https://a.fsdn.com/con/app/proj/pvpgn-phputils/screenshots/8623.jpg/1)
			
			
This is for any of you PvPGN server admins out there who want to display
your server status on your website.

online-offline.php
   Pings a PvPGN server and (optionally) Diablo 2 gameserver to see if they
   are online and then displays the server status on a website.

status.php
  Parses the server.dat file where PvPGN outputs info about users,
  games and channels online, and displays this information on a website.



## Usage


To use either of these scripts, simply include it into the page like:.
```php
<?php include('status.php'); ?>
```

or if you want to show both (and this is the recommended way):

```php
<?php
include('online-offline.php');
if ($pvpgn_online) {
    include('status.php');
}
?>
```

You will also need to set the config options at the beginning of each file.



## Contact info


Email:
mark@darkterrorsdomain.cjb.net

IRC:
Server: irc.freenode.net
Channel: #pvpgn
Nick: U-238
