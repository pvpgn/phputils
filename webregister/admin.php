<?php
require_once("config.php");
require_once("includes/admin_prefs.php");
require_once("includes/theme_handler.php");

if (!($activation['method'] = "email" || $activation['method'] = "admin")) {
	header("Location: " . $mainfile);
}

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

// If its the first time, we take them to a page where they will set the password
if ($adminprefs['firsttime'] && !($_GET['action'] == "chpass") && !($_GET['action'] == "dochpass")) {
	header("Location: " . $adminfile . "?action=chpass&lang=" . $lang);
	die();
}

// If the admin session has timed out, we show the login form:
if ($_GET['nosession']) {
	printloginscreen("nosession");
	die();
}

// Begin a new session if they just logged in, or continue a session if they have already started one
if ($_POST && !($_GET['action'] == "dochpass")) {
	if (!isset($_POST['pass'])) {
			printloginscreen(false);
		die();
	} else {
		if (md5($_POST['pass']) == $adminprefs['password'] && $_POST['user'] == $adminprefs['username']) {
			session_start();
			$_SESSION['pass'] = $adminprefs['password'];
		} else {
			printloginscreen("badadminpass");
			die();
		}
	}
} else {
	session_start();
	if (!($_SESSION['pass'] == $adminprefs['password']) && !$adminprefs['firsttime']) {
		if ($_GET['passchangesuccess']) {
			printloginscreen('passchangesuccess');
		} else {
			printloginscreen(false);
		}
		die();
	}
}

if ($_GET['action'] == "delete") {
	$dbh = @mysql_connect($dbhost,$dbuser,$dbpass);
	@mysql_select_db($dbname) or error(1,$language["dbconnecterror"],mysql_error());
	@mysql_query("DELETE FROM `awaiting_activation` WHERE acct_username = \"" . $_GET['user'] . "\";",$dbh);
	header("Location: " . $adminfile . "?deleted=" . $_GET['user'] . "&lang=" . $lang);
} else if ($_GET['action'] == "chpass") {
	readfile("themes/" . $theme . "/admintop.htm");
	if (!$adminprefs['firsttime']) {
		echo "<p><font color=\"#FF9933\"><a href=\"" . $adminfile . "?lang=" . $lang . "\">" . $language['admin_home'] . "</a></font> | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=chpass&lang=" . $lang . "\">" . $language['changepass'] . "</a></font> | <font color=\"#FF9933\"><a href=\"purge.php?admin=1&lang=" . $lang . "\">" . $language['runpurge'] . "</a></font> | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=makeacct&lang=" . $lang . "\">" . $language['admin_newacct2'] . "</a></font> | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=logout&lang=" . $lang . "\">" . $language['admin_logout'] . "</a></font></p>\r\n";
	}
	if ($_GET['badpass']) {
		echo "<P><font color=\"#FFFFFF\">" . $language["badadminpass"] . "</font></P>";
	} else if ($_GET['passmismatch']) {
		echo "<P><font color=\"#FFFFFF\">" . $language["passmismatch"] . "</font></P>";
	} else if ($adminprefs['firsttime']) {
		echo "<P><font color=\"#FFFFFF\">" . $language["firsttime"] . "</font></P>";
	}
	echo "<P><FORM METHOD=\"POST\" ACTION=\"" . $adminfile . "?action=dochpass&lang=" . $lang . "\">";
	echo "<font color=\"#FFFFFF\">";
	if ($adminprefs['firsttime']) {
		echo "<INPUT TYPE=\"HIDDEN\" NAME=\"oldpass\" VALUE=\"pvpgn\">";
	} else {
		echo $language["currpassword"] . " <INPUT TYPE=\"PASSWORD\" NAME=\"oldpass\" SIZE=40><BR>";
	}
	echo $language["newusername"] . " <INPUT TYPE=\"text\" NAME=\"username\" VALUE=\"" . $adminprefs['username'] . "\" SIZE=40><BR>";
	echo $language["newpassword"] . " <INPUT TYPE=\"PASSWORD\" NAME=\"newpass1\" SIZE=40><BR>";
	echo $language["confnewpass"] . " <INPUT TYPE=\"PASSWORD\" NAME=\"newpass2\" SIZE=40><BR>";
	echo "</font>";
	if ($adminprefs['firsttime']) {
		echo "<INPUT TYPE=\"Submit\" NAME=\"Submit\" VALUE=\"" . $language["setpass"] . "\"></P>";
	} else {
		echo "<INPUT TYPE=\"Submit\" NAME=\"Submit\" VALUE=\"" . $language["changepass"] . "\"></P>";
	}		
	readfile("themes/" . $theme . "/adminbottom.htm");
	die();
} else if ($_GET['action'] == "dochpass") {
	if (md5($_POST['oldpass']) == $adminprefs['password']) {
		if ($_POST['newpass1'] == $_POST['newpass2']) {
			$fp = @fopen("includes/admin_prefs.php","w");
			if (!$fp) {
				error(0,$language["editadminprefs"],"");
			}
			fwrite($fp, "<"."?php\r\n// This file is rewritten by admin.php sometimes\r\n// Editing this file manually is not recommended.\r\n\$adminprefs['username'] = \"" . $_POST['username'] . "\";\r\n\$adminprefs['password'] = \"" . md5($_POST['newpass1']) . "\";\r\n\$adminprefs['firsttime'] = false;\r\n?".">\r\n");
			fclose($fp);
			if (isset($_SESSION['pass'])) {
				unset($_SESSION['pass']);
			}
			header("Location: " . $adminfile . "?action=chpass&passchangesuccess=1");
		} else {
			header("Location: " . $adminfile . "?action=chpass&passmismatch=1");
		}
	} else {
		header("Location: " . $adminfile . "?action=chpass&badpass=1");
	}
} else if ($_GET['action'] == "makeacct") {
	// nothing here yet
} else if ($_GET['action'] == "logout") {
	if (isset($_SESSION['pass'])) {
		unset($_SESSION['pass']);
	}
	header("Location: " . $adminfile . "?lang=" . $lang);
	die();
} else {
	// Connect to the db for use later
	$dbh = @mysql_connect($dbhost,$dbuser,$dbpass);
	@mysql_select_db($dbname) or error(1,$language['dbconnecterror'],mysql_error());
}

function printloginscreen($msg) {
	global $language;
	global $adminfile;
	global $lang;
	if ($msg) {
		$page_data = array(
			"self" => $adminfile . "?lang=" . $lang,
			"msg" => "<p>" . $language[$msg] . "</p>");
		echo parse_theme("adminlogin.htm", $page_data);
	} else {
		$page_data = array(
			"self" => $adminfile . "?lang=" . $lang,
			"msg" => "");
		echo parse_theme("adminlogin.htm", $page_data);
	}
}

function buildusertable($dbh,$dateformat,$activation,$lang,$adminurl,$theme) {
	global $language;
	$output = "<table width=\"700\" border=\"0\" cellspacing=\"2\">\n";
	$output .= "<tr><td colspan=\"5\" bgcolor=\"#FF9933\"><b>" . $language["acctswaiting"] . "</b></td></tr>\n";
	$output .= "<tr><td bgcolor=\"#FF9933\"><b>" . $language["username"] . "</b></td><td bgcolor=\"#FF9933\"><b>" . $language["email"] . "</b></td><td bgcolor=\"#FF9933\"><b>" . $language["acctreg"] . "</b></td><td width=\"1\" bgcolor=\"#FF9933\">&nbsp;</td><td width=\"1\" bgcolor=\"#FF9933\">&nbsp;</td></tr>\n";
	$i = 0;
	$response = mysql_query("SELECT * FROM `awaiting_activation` WHERE uid != '0';",$dbh);
	while ($temp = mysql_fetch_array($response)) {
		$i++;
		extract($temp);
		if (is_int($i / 2)) {
			$output .= "<tr><td bgcolor=\"#DDDDDD\">" . $acct_username . "</td><td bgcolor=\"#DDDDDD\">";
			if ($acct_email && $acct_email <> "") {
				$output .= "<a href=\"mailto:" . $acct_email . "\">" . $acct_email . "</a>";
			} else {
				$output .= "&nbsp;";
			}
			$output .= "</td><td bgcolor=\"#DDDDDD\">" . date($dateformat,$webacct_creation_time) . "</td><td width=\"1\" bgcolor=\"#DDDDDD\"><a href=\"" . $activation['url'] . "?action=adminactivate&x=" . $webacct_activation_code . "&lang=" . $lang . "\"><img src=\"themes/" . $theme . "/tick.png\" border=\"0\" width=\"28\" height=\"20\"></a></td><td width=\"1\" bgcolor=\"#DDDDDD\"><a href=\"" . $adminurl . "?action=delete&user=" . $acct_username . "&lang=" . $lang . "\"><img src=\"themes/" . $theme . "/cross.png\" border=\"0\" witdh=\"18\" height=\"16\"></a></td></tr>\n";
		} else {
			$output .= "<tr><td bgcolor=\"#BBBBBB\">" . $acct_username . "</td><td bgcolor=\"#BBBBBB\">";
			if ($acct_email && $acct_email <> "") {
				$output .= "<a href=\"mailto:" . $acct_email . "\">" . $acct_email . "</a>";
			} else {
				$output .= "&nbsp;";
			}
			$output .= "</td><td bgcolor=\"#BBBBBB\">" . date($dateformat,$webacct_creation_time) . "</td><td width=\"1\" bgcolor=\"#BBBBBB\"><a href=\"" . $activation['url'] . "?action=adminactivate&x=" . $webacct_activation_code . "&lang=" . $lang . "\"><img src=\"themes/" . $theme . "/tick.png\" border=\"0\" width=\"28\" height=\"20\"></a></td><td width=\"1\" bgcolor=\"#BBBBBB\"><a href=\"" . $adminurl . "?action=delete&user=" . $acct_username . "&lang=" . $lang . "\"><img src=\"themes/" . $theme . "/cross.png\" border=\"0\" witdh=\"18\" height=\"16\"></a></td></tr>\n";
		}
	}
	if (!$i) {
		$output .= "<tr><td colspan=\"5\" bgcolor=\"#DDDDDD\">" . $language["noacctswaiting"] . "</td></tr>\n";
	}
	$output .= "</table>\n";
	return $output;
}

function printmakeacctform() {
	global $language;
	global $mainfile;
	global $lang;
	// Show the account creation form
	echo "<P><H3><font color=\"#FFFFFF\">" . $language['admin_newacct'] . "</font></H3></P>";
	echo "</CENTER><P><TABLE><TR><TD><FORM METHOD=\"POST\" ACTION=\"" . $mainfile . "?adminmakeacct=1&lang=" . $lang . "\">\r\n";
	?>
    <table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font color="#FFFFFF"><?php echo $language['form_username']; ?></font></td>
        <td><div align="right">
          <INPUT TYPE="TEXT" NAME="acct_username" SIZE=40>
        </div></td>
      </tr>
      <tr>
        <td><font color="#FFFFFF"><?php echo $language['form_password']; ?></font></td>
        <td><div align="right"><INPUT TYPE="PASSWORD" NAME="password1" SIZE=40> </div></td>
      </tr>
      <tr>
        <td><font color="#FFFFFF"><?php echo $language['form_confpass']; ?></font></td>
        <td><div align="right"><INPUT TYPE="PASSWORD" NAME="password2" SIZE=40> </div></td>
      </tr>
      <tr>
        <td><font color="#FFFFFF"><?php echo $language['form_email']; ?></font></td>
        <td><div align="right"><INPUT TYPE="TEXT" NAME="acct_email" SIZE=40> </div></td>
      </tr>
    </table>
    <br>
	<?php	
	echo "<font color=\"#FFFFFF\"><INPUT TYPE=\"checkbox\" NAME=\"auth_operator\" VALUE=\"true\"> auth_operator = true<BR>\r\n";
	echo "<INPUT TYPE=\"checkbox\" NAME=\"auth_admin\" VALUE=\"true\"> auth_admin = true<BR>\r\n";
	echo "auth_command_groups = <SELECT name=\"command_groups\">\r\n";
	echo "<OPTION selected value=\"1\">1</OPTION>\r\n";
	echo "<OPTION value=\"2\">2</OPTION>\r\n";
	echo "<OPTION value=\"3\">3</OPTION>\r\n";
	echo "<OPTION value=\"4\">4</OPTION>\r\n";
	echo "<OPTION value=\"5\">5</OPTION>\r\n";	
	echo "<OPTION value=\"6\">6</OPTION>\r\n";
	echo "<OPTION value=\"7\">7</OPTION>\r\n";
	echo "<OPTION value=\"8\">8</OPTION>\r\n";
	echo "</SELECT><BR>\r\n";
	echo "<INPUT TYPE=\"checkbox\" NAME=\"allchars\" VALUE=\"true\"> " . $language['form_allchars'] . "<BR><BR>\r\n";
	echo "<INPUT TYPE=\"Submit\" NAME=\"Submit\" VALUE=\"" . $language['form_submit'] . "\">\r\n";
	echo "</font></FORM></TD></TR></TABLE></P><CENTER>\r\n";
}

// Process any messages if the user is returning from activate.php or purge.php
if ($_SESSION['msg']) {
	$msg = "<p><font color=\"#FFFFFF\">" . $_SESSION['msg'] . "</font></p>";
	unset($_SESSION['msg']);
} else if ($_SESSION['acctspurged']) {
	if ($_SESSION['acctspurged'] == -1) {
		$msg = "<p><font color=\"#FFFFFF\">0 " . $language["purged"] . "</font></p>";
	} else {
		$msg = "<p><font color=\"#FFFFFF\">" . $_SESSION['acctspurged'] . " " . $language["purged"] . "</font></p>";
	}
	unset($_SESSION['acctspurged']);
} else if ($_GET['deleted']) {
	$msg = "<p><font color=\"#FFFFFF\">" . str_replace("[[acct_username]]",$_GET['deleted'],$language["admindeleted"]) . "</font></p>";
} else {
	$msg = "";
}

// Start printing the page
readfile("themes/" . $theme . "/admintop.htm");

// Print the link bar

echo "<p><font color=\"#FF9933\"><a href=\"" . $adminfile . "?lang=" . $lang . "\">" . $language['admin_home'] . "</a></font> | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=chpass&lang=" . $lang . "\">" . $language['changepass'] . "</a></font>";
echo " | <font color=\"#FF9933\"><a href=\"purge.php?admin=1&lang=" . $lang . "\">" . $language['runpurge'] . "</a></font> | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=makeacct&lang=" . $lang . "\">" . $language['admin_newacct2'] . "</a></font>";
echo " | <font color=\"#FF9933\"><a href=\"" . $adminfile . "?action=logout&lang=" . $lang . "\">" . $language['admin_logout'] . "</a></font></p>\r\n";

// Print any messages if the user is returning from activate.php or purge.php
echo $msg . "\r\n";

// Build and display the table of users awaiting activation
if ($_GET['action'] == "makeacct") {
	echo printmakeacctform();
} else {
	echo "<p>" . buildusertable($dbh,$dateformat,$activation,"en",$adminfile,$theme) . "</p>\r\n";
}

// Print the footer
echo "<p><font color=\"#FFFFFF\">" . str_replace("[[version]]",__VERSION,$language['footer']) . "</font></p>\r\n";
readfile("themes/" . $theme . "/adminbottom.htm");

// That's it!
?>
