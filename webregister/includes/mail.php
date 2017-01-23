<?php
// This function assembles and sends various emails

function mail_send($activation,$userdata,$lang,$type,$to) {
	require_once("lang/lang_" . $lang . ".php");
	global $adminfile;
	if ($type == "activationemail") {
		$page_data = array(
			"acct_username" => $userdata['acct_username'],
			"activation_link" => $activation['url'] . "?action=activate&x=" . $userdata['webacct_activation_code']);
	} else if ($type == "activatedemail") {
		$page_data = array(
			"acct_username" => $userdata['acct_username']);
	} else {
		$page_data = array(
			"adminurl" => $adminfile);
	}
	$headers = "";
	foreach($activation['headers'] as $header => $value) {
		$headers .= $header . ": " . $value . "\n";
	}
	if (@mail($to,$language["subject_" . $type],parse_theme($type . "_" . $lang . ".txt", $page_data, true),$headers)) {
		return true;
	} else {
		return false;
	}
}
?>
