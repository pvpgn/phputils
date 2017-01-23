<?php
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// config.php - Configuration file for the PvPGN Web Registration System                      //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

// ------------------------------------------------------------------------------------------ //
// Database settings                                                                          //
// ------------------------------------------------------------------------------------------ //

$dbhost = "localhost";       // MySQL Database Hostname
$dbname = "pvpgn";           // MySQL Database Name
$dbuser = "pvpgn";           // MySQL Username
$dbpass = "pvpgnrocks";      // MySQL Password

// ------------------------------------------------------------------------------------------ //
// Page settings                                                                              //
// ------------------------------------------------------------------------------------------ //

// The theme you want to use.  This must be in the "themes" directory.  For info on
// making your own themes, see readme-themes.txt.  Two themes, "pvpgn" and "basic",
// are included with this script.
$theme = "pvpgn";

// The URL to the main file (index.php unless you renamed it).  Put the absolute URL here if
// you are having problems.
$mainfile = "index.php";

// The URL to admin.php.  Put the absolute URL here if you are having problems.
$adminfile = "admin.php";

// Date format in PHP date() syntax
$dateformat = "l F j, Y G:i:s";

// ------------------------------------------------------------------------------------------ //
// Policy options                                                                             //
// ------------------------------------------------------------------------------------------ //

// This should be identical to account_allowed_symbols in bnetd.conf.  The default will
// work fine unless you changed it in bnetd.conf.
$account_allowed_symbols = "-_[]";

// Must a user provide their email address?  false means that the email address is optional.
$require_email = true;

// Would you like to have a limit of one account per email address?
$one_acct_per_email = true;

// ------------------------------------------------------------------------------------------ //
// Language setup                                                                             //
// ------------------------------------------------------------------------------------------ //

// Default language.  The appropriate language file must be in the includes directory.
$lang_default = "en";

// Would you like to show a Javascript menu where visitors can choose what language to view
// the page in?
$lang_displaymenu = true;

// Languages that should appear in the language list.  They will appear in the order listed here.
$lang_menu = array(
			"English" => "en",
			"Serbian" => "sr",
			"Croatian" => "cr");

// ------------------------------------------------------------------------------------------ //
// Account activation (optional)                                                              //
// ------------------------------------------------------------------------------------------ //

// For those of you who are sick of having noobs create heaps of accounts on your PvPGN server,
// or if you want to have a private server without any intruders, here you can turn on account
// activation.  There are two activation methods that you can choose from:
//
// - The user is sent an activation email containing a link.  They must click on the link in the
//   email to activate their account.  This requires sendmail or a similar mail server software
//   to be set up on your server.  Mail is sent using the PHP mail() function.
//                                   -- OR --
// - New accounts must be approved by an administrator

// Activation method: can be "none", "email" or "admin"
$activation['method'] = "none";
// If you set this to none, you can ignore the rest of the config file.

// Number of seconds (yes, seconds) after which the account will be deleted if it is not activated.
// Account purging will only take place when purge.php is run.
$activation['expiry'] = 259200;    // 72 hours

// The URL to activate.php.  This is the URL that will be included in the email
$activation['url'] = "http://.../activate.php";


///// Setup for email activation ////////////////////////////////////////////////////////////////

// Email headers.  This is in the form of header => value.  In most cases, the only headers
// needed here are From and Reply-to.  If you need to add additional email headers, just
// add more rows to the array.
$activation['headers'] = array(
							"From" => "admin@yoursite.com",
							"Reply-to" => "admin@yoursite.com");

// To edit the content of the email that is sent to the user, edit the file called
// "activationemail_<lang>.txt" in the includes/lang directory.


///// Setup for admin activation ////////////////////////////////////////////////////////////////

// Do you want to recieve email notification when an account is awaiting admin approval?
$activation['notifyadmin'] = true;

// What email address should the notification be sent to?
$activation['adminemail'] = "admin@yoursite.com";

// When an admin has approved a new account, should the user be notified?
$activation['notifyuser'] = true;

// Visit admin.php to set the admin username and password

?>
