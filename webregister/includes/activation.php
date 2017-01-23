<?php

// This function will generate a random, unique activation code.  We check in the database to make
// sure the activation code is unique.  If the activation code is not unique we generate a new one.

function generate_activation_code($dbh) {
	do {
		$activation_code = md5(rand(1,1000000));
	} while(@mysql_fetch_row(@mysql_query("SELECT * FROM `awaiting_activation` WHERE webacct_activation_code = \"" . $activation_code . "\";",$dbh)));
	return $activation_code;
}

function email_activation($data,$activation,$lang,$dbh) {
	global $language;

	// The first step is to make sure that there isn't already a user with this username
	// that is awaiting activation.
	if (@mysql_fetch_row(@mysql_query("SELECT * FROM `awaiting_activation` WHERE acct_username = \"" . $data['acct_username'] . "\";",$dbh))) {

	// It appears that this user is already awaiting activation, so let's tell them that, and
	// offer to resend the activation email.
		$page_data = array(
			"title" => $language["title"] . " :: " . $language["title_error"],
			"message" => $data['acct_username'] . $language["alreadywaiting"] . "</p><p>" . str_replace("[[resend_url]]",$activation['url'] . "?action=resend&user=" . $data['acct_username'] . "&lang=" . $lang,$language["resend"]));
		echo parse_theme("general_message.htm", $page_data);
	} else {

		// If the server admin has set $one_acct_per_email = true in config.php, we make sure that
		// this email address is unique.
		if ($one_acct_per_email) {
			if (@mysql_fetch_row(@mysql_query("SELECT * FROM `awaiting_activation` WHERE acct_email = \"" . trim($_POST['acct_email']) . "\";",$dbh))) {
				error(0,$language['oneemailonly'],"");
			}
		}

	// It appears that this is a new user, so lets save their details into the awaiting_activation
	// table and send them an email.
		if ($row = @mysql_fetch_row(@mysql_query("SELECT MAX(`uid`) FROM `awaiting_activation`",$dbh))) {
			unset($data['acct_userid']);
			$data['uid'] = $row[0] + 1;
			$data['webacct_activation_code'] = generate_activation_code($dbh);
			$data['webacct_creation_time'] = time();
			InsertData($data,"awaiting_activation");
			if (!mail_send($activation,$data,$lang,"activationemail",$data['acct_email'])) {
				error(0,$language["emailsenderror"],"");
			}
		} else {
			error(1,$language['dbreaderror'],mysql_error());
		}

	// Everything went smooth, lets show them a confirmation page.
		$page_data = array(
			"title" => $language["title"] . " :: " . $language["title_waiting"],
			"message" => str_replace("[[acct_email]]",$data['acct_email'],str_replace("[[acct_username]]",$data['acct_username'],$language['sent'])));
		echo parse_theme("general_message.htm", $page_data);
	}
}

function admin_activation($data,$activation,$lang,$dbh) {
	global $language;
	global $lang_default;

	// The first step is to make sure that there isn't already a user with this username
	// that is awaiting activation.
	if (@mysql_fetch_row(@mysql_query("SELECT * FROM `awaiting_activation` WHERE acct_username = \"" . $data['acct_username'] . "\";",$dbh))) {

	// It appears that this user is already awaiting activation, so let's tell them that.
		$page_data = array(
			"title" => $language["title"] . " :: " . $language["title_error"],
			"message" => $data['acct_username'] . $language["alreadywaiting"]);
		echo parse_theme("general_message.htm", $page_data);
	} else {

		// If the server admin has set $one_acct_per_email = true in config.php, we make sure that
		// this email address is unique.
		if ($one_acct_per_email) {
			if (@mysql_fetch_row(@mysql_query("SELECT * FROM `awaiting_activation` WHERE acct_email = \"" . trim($_POST['acct_email']) . "\";",$dbh))) {
				error(0,$language['oneemailonly'],"");
			}
		}

	// It appears that this is a new user, so lets save their details into the awaiting_activation table
		if ($row = @mysql_fetch_row(@mysql_query("SELECT MAX(`uid`) FROM `awaiting_activation`",$dbh))) {
			unset($data['acct_userid']);
			$data['uid'] = $row[0] + 1;
			$data['webacct_activation_code'] = generate_activation_code($dbh);
			$data['webacct_creation_time'] = time();
			$data['webacct_lang'] = $lang;
			InsertData($data,"awaiting_activation");
			
	// Now lets annoy the admin and tell them that they have an account awaiting approval.  Hehe.
			if ($activation['notifyadmin']) {
				if (!mail_send($activation,$data,$lang_default,"adminemail",$activation['adminemail'])) {
					error(0,$language["emailsenderror"],"");
				}
			}
		} else {
			error(1,$language['dbreaderror'],mysql_error());
		}

	// Everything went smooth, lets show them a confirmation page.
		if ($activation['notifyuser']) {
			$page_data = array(
				"title" => $language["title"] . " :: " . $language["title_success"],
				"message" => $language["waitforadmin"] . " " . $language["waitforadmin2"]);
		} else {
			$page_data = array(
				"title" => $language["title"] . " :: " . $language["title_success"],
				"message" => $language["waitforadmin"]);
		}
		echo parse_theme("general_message.htm", $page_data);
	}
}
?>
