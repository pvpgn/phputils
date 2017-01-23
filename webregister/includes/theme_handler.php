<?php
require_once("version.php");
require_once("config.php");

define("__THEME",$theme);

function parse_theme($theme_file, $page_data, $email = false) {
	global $language;
	if ($email) {
		$filepath = "includes/lang/" . $theme_file;
	} else {
		$filepath = "themes/" . __THEME . "/" . $theme_file;
	}
	if (!file_exists($filepath) || !is_file($filepath)) {
		error(0,str_replace("[filename]",$filepath,$language['missingfile']),"");
	}
	$fp = @fopen($filepath,"r") or error(0,str_replace("[filename]",$filepath,$language['fopenerror']),"");
	$size = filesize($filepath);
	$content = fread($fp,$size);
	fclose($fp);
	foreach($page_data as $key => $val) {
//			echo "Key: " . $key . ", Value: " . $val . "<br>";
			$content = str_replace("[[" . $key . "]]",$val,$content);
	}
	$content = str_replace("[[footer]]",str_replace("[[version]]",__VERSION,$language['footer']),$content);
	return $content;
}

function parse_error_theme($theme_file, $page_data) {
	global $language;
	$filepath = "themes/" . __THEME . "/" . $theme_file;
	if (!file_exists($filepath) || !is_file($filepath)) {
		errorstandalone($page_data);
	}
	$fp = @fopen($filepath,"r") or die($filepath . " could not be opened when trying to generate an error page");
	$size = filesize($filepath);
	$content = fread($fp,$size);
	fclose($fp);
	foreach($page_data as $key => $val) {
//		echo "Key: " . $key . ", Value: " . $val . "<br>";
		$content = str_replace("[[" . $key . "]]",$val,$content);
	}
	$content = str_replace("[[footer]]",str_replace("[[version]]",__VERSION,$language['footer']),$content);
	return $content;
}

function error($mysql, $errormsg, $sqlerrormsg) {
	global $language;
	if ($mysql) {
		$page_data = array(
			"title" => $language["title"] . " :: " . $language["title_sqlerror"],
			"lang_sqlerror" => $language["sqlerror"],
			"lang_sqlsaid" => $language["sqlsaid"],
			"errormsg" => $errormsg,
			"sqlerrormsg" => $sqlerrormsg);
		echo parse_error_theme("sql_error.htm", $page_data);
	} else {
		$page_data = array(
			"title" => $language["title"] . " :: " . $language["title_error"],
			"lang_error" => $language["error"],
			"errormsg" => $errormsg);
		echo parse_error_theme("error.htm", $page_data);
	}
	die();
}
?>