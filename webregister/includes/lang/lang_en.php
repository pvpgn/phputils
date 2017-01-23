<?php
////////////////////////////////////////////////////////////////////////////////////////////
///                                                                                      ///
///  lang_en.php - English language constants for the PvPGN Web Registration System      ///
///                                                                                      ///
////////////////////////////////////////////////////////////////////////////////////////////

// These are used for the page titles
$language['title'] =			"PvPGN Web Registration System";
$language['title_activated'] =	"Activation success";
$language['title_resent'] =		"Activation email resent";
$language['title_waiting'] =	"Account awaiting activation";
$language['title_success'] =	"Success";
$language['title_error'] =		"Error";
$language['title_sqlerror'] =	"MySQL Error";

// Activation notices
// Example:  "JoeUser, your account is already awating activation."
$language['alreadywaiting'] = 	", your account is already awaiting activation.";

// Example:  "JoeUser, your account has been successfully activated!";
$language['activated'] =		", your account has been successfully activated!";

// Similar thing here :-)
$language['created'] =			", your account was created successfully!";

// If someone creates a user account and admin activation is enabled:
$language['waitforadmin'] =		"Thankyou for registering!  Your account must be approved before you can play on our server.";
$language['waitforadmin2'] = 	"We will send you an email when your account has been approved.";

// Admin interface messages
$language['passchangesuccess'] = "Your password was changed successfully.  Please log in again below:";
$language['firsttime'] =		"This is the first time you have used the admin interface.  Please set your username and password below:";

$language['acctswaiting'] =		"Accounts awaiting activation:";
$language['noacctswaiting'] =	"There are currently no users awaiting activation";

$language['admin_home'] =		"Home";
$language['admin_logout'] =		"Logout";
$language['admin_newacct2'] =	"Create a new account";
$language['admin_newacct'] =	"Create a new account:";
$language['runpurge'] =			"Run purge.php";
// Example: 10 accounts purged
$language['purged'] = 			"accounts purged";

// These are used in the table of users
$language['username'] =			"Username";
$language['email'] =			"Email";
$language['acctreg'] =			"Account registered";
$language['activate'] =			"Activate";

// These are used in the signup form
$language['form_username'] =	"Username:";
$language['form_password'] =	"Password:";
$language['form_confpass'] =	"Confirm password:";
$language['form_email'] =		"Email address:";
$language['form_submit'] =		"Create new account!";
// On the admin-only signup form...
$language['form_allchars'] =	"Bypass the account_allowed_symbols check";

// Admin change password screen
$language['currpassword'] =		"Current password:";
$language['newusername'] = 		"New username:";
$language['newpassword'] =		"New password:";
$language['confnewpass'] =		"Confirm new password:";
$language['setpass'] =			"Set password";
$language['changepass'] =		"Change password";

////// Error messages //////
$language['error'] =			"Error:";
$language['sqlerror'] =			"MySQL Error:";
$language['sqlsaid'] =			"MySQL said:";

// Account creation error messages.
$language['userexists'] = 		"A user with that name already exists.";
$language['passmismatch'] = 	"The password and repeated password do not match.";
$language['shortpass'] = 		"Your password must be at least 3 characters long.";
$language['bademail'] = 		"The email address is invalid.";
$language['noemail'] = 			"You must supply an email address.";
$language['oneemailonly'] = 	"Sorry, only one account per email is allowed.";

// Account activation error messages.
$language['invalidcode'] = 		"The specified activation code is invalid. This account may already have been activated.";
$language['notwaiting'] =		"The username you specified is not currently awaiting activation.";

// Database error messages.
$language['dbconnecterror'] = 	"Could not connect to the database.";
$language['dbinserterror'] = 	"Error inserting data into database.";
$language['dbdeleteerror'] = 	"Error deleting data from the database.";
$language['dbreaderror'] = 		"Could not read data from the database.";

// Email error messages.
$language['emailsenderror'] = 	"Error when trying to send mail.";

// Admin interface error messages.
$language['nosession'] = 		"Your admin session has timed out. Please log in again:";
$language['badadminpass'] = 	"Incorrect password";
$language['editadminprefs'] = 	"Could not open admin_prefs.php for writing";

// Email subject lines
// For email activation: the activation email
$language['subject_activationemail'] = "Your new PvPGN account";

// For admin activation: this is sent to the user after their account has been approved
$language['subject_activatedemail'] = "Your PvPGN account has been approved";

// For admin activation: this email is sent to the admin when there is an account waiting
$language['subject_adminemail'] = "Please approve this new account";

/************************************************************************
 *                  --- Special language constants ---                  *
 *  These have various bits of information substituted into them.       *
 *  Make sure you read the comments and be careful when editing these!  *
 ************************************************************************/

// These must have [[filename]] in the appropriate place.
$language['missingfile'] = 		"A required file, [[filename]], is missing.";
$language['fopenerror'] =		"[[filename]] appears to exist, but could not be opened.  Check permissions.";

// In the following, [[allowed_chars]] will be replaced by $account_allowed_chars as specified in config.php.
$language['invalidname'] = 		"Your username contains invalid characters. Only alphanumeric characters and [[allowed_chars]] are allowed.";

// This must contain [[resend_url]], that being the link that a user would click on to have the activation email resent.
$language['resend'] = 			"If you would like us to resend the activation email, please click <a href=\"[[resend_url]]\">here</a>.";

// This must contain [[acct_username]] and [[acct_email]]
$language['sent'] =				"[[acct_username]], we have sent you an activation email at [[acct_email]]. Please follow the instructions in this email to activate your account.";

// This must contain [[acct_username]] and [[acct_email]]
$language['resent'] =			"[[acct_username]], we have resent your activation email to [[acct_email]]. Please follow the instructions in this email to activate your account.";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['admincreated'] =		"Account \"[[acct_username]]\" created";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['adminactivated'] =	"Account \"[[acct_username]]\" activated";

// This is used in the admin interface.  Must contain [[acct_username]]
$language['admindeleted'] =		"Account \"[[acct_username]]\" deleted";

// This must contain [[version]]
$language['footer'] =			"PvPGN Web Registration System [[version]] by <A HREF=\"mailto:mark@darkterrorsdomain.cjb.net\">U-238</A> and fixex by<A HREF=\"http://dotaworld.net/\">BeNBeN</a> ";

?>
