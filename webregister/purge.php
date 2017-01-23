<?php
require_once("config.php");
$i = 0;
$output = "";
$oldacct = time() - $activation['expiry'];
$dbh = mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname) or die(mysql_error());
$query = mysql_query("SELECT * FROM `awaiting_activation`;");
while ($data = @mysql_fetch_array($query)) {
	extract($data);
	if ($oldacct > $webacct_creation_time && $uid) {
		mysql_query("DELETE FROM `awaiting_activation` WHERE acct_username = \"" . $acct_username . "\";");
		$output .= "Deleted account \"" . $acct_username . "\"<br>\r\n";
		$i++;
	}
}
if ($_GET['admin']) {
	require_once("includes/admin_prefs.php");
	session_start();
	if (!($_SESSION['pass'] == $adminprefs['password'])) {
		header("Location: " . $adminfile . "?nosession=1");
		die();
	}
	if ($i == 0) {
		$_SESSION['acctspurged'] = -1;
	} else {
		$_SESSION['acctspurged'] = $i;
	}
	header("Location: " . $adminfile . "?lang=" . $_GET['lang']);
} else {
	echo $output;
	echo $i . " accounts purged\r\n";
}
?>
