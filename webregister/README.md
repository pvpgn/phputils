
PvPGN Web Registration System
====

This script allows a vistor to a website to create a new account
on a PvPGN server.  It allows you to limit the number of users
on your PvPGN server through email activation, or if you wish
to have a private server you can use this script to ensure that
all new accounts must be approved by an administrator.

PvPGN 1.6.0 or later with MySQL support is required.


## Credits


This script was written by U-238

The included PvPGN password hashing script (pvpgn_hash.php) was
written by Aaron aka pandaemonium



## Current features


- Takes username and password from an online form to create a new PvPGN
  user.
- Password is encrypted using the PvPGN hash
- Checks to make sure that a user with that name does not already exist
- Checks to make sure that only allowed symbols are used in a username
- Checks to make sure that the password is at least 3 characters long
- The theme can be easily modified to suit your website
- Full multi-language support
- Easy to use admin interface allows you to create new users with special
  attributes (such as an admin account for example)

- (Optional) Email activation, so new users are sent an email containing
  a link they must click on to activate their account.  This is useful
  if you want to limit the amount of accounts on your PvPGN server.

- (Optional) Admin activation, so new accounts must be approved by an admin.
  This is very useful if you want to have a private server without any
  outsiders.

Got a feature request?  Post it here:
http://sourceforge.net/tracker/?group_id=111233&atid=658736


## Installation instructions

1.  Edit the file config.php and edit all configuration options to suit
    your needs.

2.  If you are going to use account activation, you will need to import
    awaiting_activation.sql into your PvPGN database.

3.  (Optional) Translate into your native language if needed by editing
    the files in the includes/lang directory

4.  (Optional) Customise the theme to suit your website.  See the files
    in the themes directory to do this.

4.  Put all the files into a web-accessible directory

5.  Make sure that includes/admin_prefs.php is world writable (chmod +w)

6.  In bnetd.conf, set:
    load_new_account = true

7.  Restart PvPGN

8.  Visit admin.php to set the admin username and password (only if you
    have account activation enabled)


Note: If you are using email activation, there will be some people who may
not activate their account.  This would result in users being stored in the
awaiting_activation table for no reason.

For this reason, you should perhaps set up a cron job to run purge.php
periodically (using curl).  An example crontab entry would look like this:

`*/30 * * * * /usr/bin/curl http://.../purge.php > /dev/null 2>&1`

This would run purge.php every 30 minutes.

purge.php will simply delete any account from the awaiting_activation table
that is considered "old". In config.php you can set the time after which an
account is considered "old", the default is 72 hours.


## Contact details


All bug reports should be posted here:
http://sourceforge.net/tracker/?group_id=111233&atid=658733

All feature requests should be posted here:
http://sourceforge.net/tracker/?group_id=111233&atid=658736


I can be contacted by email or on IRC (I prefer IRC)

Email:
mark@darkterrorsdomain.cjb.net

IRC:
Server:   irc.pvpgn.org
Channel:  #pvpgn
Nick:     U-238
