<?php
// ------------------------------------------------------------------------------------------ //
//                                                                                            //
// activate.php - Account activation script for the PvPGN Web Registration System             //
//                                                                                            //
// ------------------------------------------------------------------------------------------ //

// This file handles account activation.  This is the file that users will be sent to when
// they click on the activation link in their email.  This file also handles resending of the
// activation email.

// Lets begin by including some files that we will need:
require_once("config.php");
require_once("includes/mail.php");
require_once("includes/theme_handler.php");
require_once("includes/insertdata.php");

// Load up the language constants
if ($_GET['lang']) {
	if (file_exists("includes/lang/lang_" . $_GET['lang'] . ".php") && is_file("includes/lang/lang_" . $_GET['lang'] . ".php")) {
		require_once("includes/lang/lang_" . $_GET['lang'] . ".php");
		$lang = $_GET['lang'];
	} else {
		header("Location: " . $mainfile);
		die();
	}
} else {
	$lang = $lang_default;
	if (!require_once("includes/lang/lang_" . $lang_default . ".php")) {
		die("An invalid language was specified in config.php\n");
	}
}

// If an admin is activating this account, we'll continue their session.
if ($_GET['action'] == "adminactivate") {
	require_once("includes/admin_prefs.php");
	session_start();
	if (!($_SESSION['pass'] == $adminprefs['password'])) {
		header("Location: " . $adminfile . "?nosession=1&lang=" . $lang);
		die();
	}
}

// We will start by connecting to the database:
$dbh = @mysql_connect($dbhost,$dbuser,$dbpass);
@mysql_select_db($dbname) or error(1,$language["dbconnecterror"],mysql_error());

if ($_GET['action'] == "activate" || $_GET['action'] == "adminactivate") {
	if ($activation_code = $_GET['x']) {

		// Lets find the info that is associated with the activation code given...
		if ($array = @mysql_fetch_array(@mysql_query("SELECT * FROM `awaiting_activation` WHERE webacct_activation_code = \"" . $activation_code . "\";",$dbh))) {

		// ... and save this info into an array for insertion into the BNET table.
			extract($array);
			$data['acct_username'] = $acct_username;
            $data['username'] = $acct_username;
			$data['acct_passhash1'] = $acct_passhash1;
			$data['acct_email'] = $acct_email;
			
		// We will get the max user id from the BNET table, and +1 to this.  This will be the user id
		// of the user we are about to activate.
			$row = @mysql_fetch_row(@mysql_query("SELECT MAX(`uid`) FROM `pvpgn_BNET`;",$dbh));
			$data['uid'] = $row[0] + 1;
			$data['acct_userid'] = $data['uid'];
		
		// Now insert the data into BNET...
			InsertData($data,"pvpgn_BNET");

		// ... delete the user from the awaiting_activation table ...
			if (!mysql_query("DELETE FROM `awaiting_activation` WHERE webacct_activation_code = \"" . $activation_code . "\";",$dbh)) {
				error(0,$language["dbdeleteerror"],"");
			}
		// ... and show the user a confirmation page.  Their account is now activated.
			if ($_GET['action'] == "activate") {
				$page_data = array(
					"title" => $language["title"] . " :: " . $language["title_activated"],
					"message" => $acct_username . $language["activated"]);
				echo parse_theme("general_message.htm", $page_data);
			} else {

				// If an admin is activating this account and user notification is turned on, we will email the user
				// to tell them that their account has been approved.  This email is sent in the language that the
				// user selected when registering their account
				if ($activation['notifyuser'] && $activation['method'] == "admin") {
					if (!mail_send($activation,$data,$webacct_lang,"activatedemail",$acct_email)) {
						error(0,$language["emailsenderror"],"");
					}
				}
				$_SESSION['msg'] = str_replace("[[acct_username]]",$acct_username,$language["adminactivated"]);
				header("Location: " . $adminfile . "?lang=" . $lang);
			}
		} else {
			// If an invalid activation code was specified, we show the user an error page
			error(0,$language["invalidcode"],"");
		}
	} else {
		// If no activation code was specified, we'll send them to the main page
		header("Location: " . $mainfile);
	}
} else if ($_GET['action'] == "resend") {
	if ($acct_username = $_GET['user']) {
	
		// This is where we resend the activation email.  First we find the user's activation code
		// and email address
		if ($row = @mysql_fetch_row(@mysql_query("SELECT acct_email,webacct_activation_code FROM `awaiting_activation` WHERE acct_username = \"" . $_GET['user'] . "\";",$dbh))) {
		
			// We save this info into an array which we will pass to the email handler
			$data['acct_username'] = $_GET['user'];
			$data['acct_email'] = $row[0];
			$data['webacct_activation_code'] = $row[1];

			// Now hand over to the email handler, which will assemble this information into an email
			// and send it
			if (!mail_send($activation,$data,$lang,"activationemail",$data['acct_email'])) {
				error(0,$language["emailsenderror"],"");
			}
		
			// Now show the user a confirmation page
			$page_data = array(
				"title" => $language["title"] . " :: " . $language["title_resent"],
				"message" => str_replace("[[acct_email]]",$data['acct_email'],str_replace("[[acct_username]]",$data['acct_username'],$language["resent"])));
			echo parse_theme("general_message.htm", $page_data);			
						
		} else {
			// The username specified is invalid.
			header("Location: " . $mainfile);
		}
	} else {
		// If there were arguments missing, we send the user to the main page:
		header("Location: " . $mainfile);
	}
} else {
	header("Location: " . $mainfile);
}
?>
