<?php
error_reporting (E_ERROR | E_WARNING | E_PARSE);
include("config.inc.php");

$login_redirect = "<meta http-equiv=refresh content=\"0; url=login.php\">";
$admin_redirect = "<meta http-equiv=refresh content=\"0; url=admin.php\">";

session_start();
if($_GET['logout']) {
	session_unset();
	session_destroy();
	if (!headers_sent()) {
		header ('Location: login.php');
	exit;
	}
	else {
		print $login_redirect;
	exit;
	}
	exit();
}
if($_POST['user']) {
	if($_POST['user'] == $site_user) {
		if(md5($_POST['password']) == $site_pass) {
			session_register('user');
			$_SESSION['user'] = "true";
			if (!headers_sent()) {
				header ('Location: admin.php');
			exit;
			}
			else {
				print $admin_redirect;
			exit;
			}
		}
		else
	if (!headers_sent()) {
		header ('Location: login.php');
	exit;
	}
	else {
		print $login_redirect;
	exit;
	}
	}
	else
	if (!headers_sent()) {
		header ('Location: login.php');
	exit;
	}
	else {
		print $login_redirect;
	exit;
	}
}
?>
<html>
<head>
<title>PvPGN Statistics System Administrator Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="themes/<?php echo $site_theme ?>/main.css" rel="stylesheet" type="text/css" />
</head>



<LINK href="themes/bnet/res/war3-human-ie.css" type=text/css rel=stylesheet>
<LINK href="themes/bnet/res/war3-ladder-ranking.css" type=text/css rel=stylesheet>

<BODY bgColor=#000000 leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">
<DIV style="WIDTH: 100%; POSITION: absolute; TOP: 85px; TEXT-ALIGN: center">
<CENTER>

<SCRIPT language=JavaScript 
src="themes/bnet/res/layerFunctions.js"></SCRIPT>

<SCRIPT language=JavaScript 
src="themes/bnet/res/detection2.js"></SCRIPT>

<SCRIPT language=JavaScript 
src="themes/bnet/res/detection.js"></SCRIPT>

  </TBODY></div>

<body leftmargin="10" topmargin="10" marginwidth="10" marginheight="10">
<form action="login.php" method="POST">
<br><br><br>
<div style="font-size: 2em;">Admin Log In</div><br />
<br>
<div align="center">[ <a href="stats.php">Back to the stats</a> ]</div>
<br><table border="0" class='menu' align="center"><tr><td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<td><font size='1'><b><span>Please Log in:</span></b></font></td>
<table cellpadding="0" cellspacing="1" border="0">
<tr>
<td><input type="text" class='boxes' name="user" /></td>
<td><input type="password" class='boxes' name="password" /></td>
<td><input type="submit" class='boxes' value="login" /></td>
</tr>
<tr>
<td><font size="1">Username</font></td>
<td colspan="2"><font size="1">Password</font></td>
</tr></td></tr>
</table></table></form>
<p align="center"><font size="1">PvPGN Statistics System v<?php echo $stats_version ?> Administrator Control Panel</font></p>
</body>
</html>