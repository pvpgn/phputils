<?php
// ----------------------------------------------------------------------
// Player -vs- Player Gaming Network Statistics System
// http://www.stormzone.ru/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original author: jfro (imeepmeep@hotmail.com)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------

error_reporting (E_ERROR | E_WARNING | E_PARSE);
include("includes/page_handler.php");
include("includes/pvpgn_admin.php");
include("includes/pvpgn_rank.php");
include("config.inc.php");

$login_redirect = "<meta http-equiv=refresh content=\"0; url=login.php\">";
$admin_redirect = "<meta http-equiv=refresh content=\"0; url=admin.php\">";

session_start();
if(!session_is_registered('user'))
	if (!headers_sent()) {
		header ('Location: login.php');
	exit;
	}
	else {
		print $login_redirect;
	exit;
	}

$page = new page_handle();
$admin = new pvpgn_admin();
$ranker = new pvpgn_rank();
$current_page = $_GET['current_page'];
$sort_by = $_GET['sort_by'];
$sort_direction = $_GET['sort_direction'];

if($_GET['mode'] == "ranks") {
	$games = array("STAR","SEXP","WAR3","W3XP","W2BN","DRTL","D2XP","D2DV");
	$types = array(
		"STAR"=>array("0"),
		"SEXP"=>array("0"),
		"W2BN"=>array("0"),
		"WAR3"=>array("solo","team","ffa"),
		"W3XP"=>array("solo","team","ffa"),
		"DRTL"=>array("0"),
		"D2DV"=>array("SC","HC"),
		"D2XP"=>array("SC","HC")
	);
	if($_GET['update'] == "ranks") {
		$ranker->update_ranks($_GET['game'],$_GET['type']);
	}
	$rows = array(
		array("name"=>"Starcraft","code"=>"STAR","type"=>0),
		array("name"=>"Broodwar","code"=>"SEXP","type"=>0),
		array("name"=>"Diablo","code"=>"DRTL","type"=>0),
		array("name"=>"Diablo 2 SC","code"=>"D2DV","type"=>"SC"),
		array("name"=>"Diablo 2 HC","code"=>"D2DV","type"=>"HC"),
		array("name"=>"Diablo 2 LOD SC","code"=>"D2XP","type"=>"SC"),
		array("name"=>"Diablo 2 LOD HC","code"=>"D2XP","type"=>"HC"),
		array("name"=>"Warcraft 2","code"=>"W2BN","type"=>0),
		array("name"=>"Warcraft 3 Solo","code"=>"WAR3","type"=>"solo"),
		array("name"=>"Warcraft 3 AT","code"=>"WAR3","type"=>"team"),
		array("name"=>"Warcraft 3 FFA","code"=>"WAR3","type"=>"ffa"),
		array("name"=>"Warcraft 3: Frozen Throne Solo","code"=>"W3XP","type"=>"solo"),
		array("name"=>"Warcraft 3: Frozen Throne AT","code"=>"W3XP","type"=>"team"),
		array("name"=>"Warcraft 3: Frozen Throne FFA","code"=>"W3XP","type"=>"ffa")
	);

	$rows['theme_file'] = "game_rank.html";

	$page_data = array("content"=>$rows,"site_theme"=>$site_theme,"stats_version"=>$stats_version);
	$page->setup($site_theme,"rank.layout.html",$page_data);
	$page->parse();
	print $page->fetch();
}

else if($_GET['mode'] == "pass") {
	if($_POST['encode']) {
	  $enc = md5($_POST['pass2']);
	}
	else
	  $enc = "";

		$page_data = array("encrypted"=>$enc,"site_theme"=>$site_theme,"stats_version"=>$stats_version);
		$page->setup($site_theme,"pass.layout.html",$page_data);
		$page->parse();
		print $page->fetch();
}

else if($_GET['mode'] == "users" || !isset($_GET['mode'])) {
	if(!isset($_POST['submit'])) {
		if(!isset($current_page)) {
			$current_page = 0;
		}
		$page_num = $current_page * $page_max;
		if(isset($_POST['submit_new_user'])) {
			$new_username = $_POST['username'];
			$new_password = $_POST['password'];
			$fp = fsockopen($pvpgn_ip, $pvpgn_port, $errno, $errstr, 50);
				if (!$fp) {
					echo "$errstr ($errno)<br>\n";
				} else {
				fwrite($fp,"\r\n$admin_username\r\n$admin_password\r\n/addacct\r$new_username\r$new_password\r\n");
				stream_set_timeout($fp,0,$timeout*1000);
				fclose($fp);
			}
		}
		if(isset($_POST['user_search'])) {
			$user_search = $_POST['user_search'];
			if($_POST['user_method'] == "contains") {
	        	$exact = false;
	        }
	        else
	        	$exact = true;
	  		$users = $admin->user_search($user_search,$exact);
	  		list($users1,$users2) = array($users,ceil(count($users)/2));
	
		}
		else {
			if(!isset($sort_by))
				$sort_by = $default_sort_by;
			if(!isset($sort_direction))
				$sort_direction = $default_sort_dir;
			$users1 = $admin->get_users($page_num,$page_max/2,$sort_by,$sort_direction);
			$users2 = $admin->get_users($page_num+($page_max/2),$page_max/2,$sort_by,$sort_direction);
			$user_count = $admin->num_of_users();
			$max_pages=ceil(( $user_count / $page_max)) - 1;
			$control = "";
			if($current_page > 0) {
	    	    $control .= "<div align=\"center\">[ <a href=\"admin.php?current_page=0&sort_by=$sort_by&sort_direction=$sort_direction\">First</a> ] [ <a href=\"admin.php?current_page=".($current_page - 1)."&sort_by=$sort_by&sort_direction=$sort_direction\">Previous</a> ] ";
			}
			if($current_page < $max_pages) {
	    	    $control .= "[ <a href=\"admin.php?current_page=".($current_page + 1)."&sort_by=$sort_by&sort_direction=$sort_direction\">Next</a> ] [ <a href=\"admin.php?current_page=$max_pages&sort_by=$sort_by&sort_direction=$sort_direction\">Last</a> ]";
			}
			$control .= "Page: ".($current_page+1)." of ".($max_pages+1)."</div><br />";
		}
	
		$users1['theme_file'] = "user_row.html";
		$users2['theme_file'] = "user_row.html";

		$page_data = array("content1"=>$users1,"content2"=>$users2,"control"=>$control,"site_theme"=>$site_theme,"stats_version"=>$stats_version);
		$page->setup($site_theme,"user.layout.html",$page_data);
		$page->parse();
		print $page->fetch();
	}

else if($_POST['submit']) {
	if(!is_array($_POST['lock_uids']))
		$_POST['lock_uids'] = array();
	if(!is_array($_POST['uids']))
		$_POST['uids'] = array();
	if(!is_array($_POST['delete_uids']))
		$_POST['delete_uids'] = array();
	if(!is_array($_POST['operator_uids']))
		$_POST['operator_uids'] = array();
	if(!is_array($_POST['admin_uids']))
		$_POST['admin_uids'] = array();
	foreach(array_diff($_POST['uids'],$_POST['lock_uids']) as $a_user) {
		$admin->user_unlock($a_user);
	}
	foreach($_POST['lock_uids'] as $a_user) {
		$admin->user_lock($a_user);
	}
	foreach(array_diff($_POST['uids'],$_POST['operator_uids']) as $a_user) {
		$admin->user_operator($a_user,"false");
	}
	foreach($_POST['operator_uids'] as $a_user) {
		$admin->user_operator($a_user,"true");
	}
	foreach(array_diff($_POST['uids'],$_POST['admin_uids']) as $a_user) {
		$admin->user_admin($a_user,"false");
	}
	foreach($_POST['admin_uids'] as $a_user) {
		$admin->user_admin($a_user,"true");
	}
	foreach($_POST['delete_uids'] as $a_user) {
		$admin->user_delete($a_user);
	}
	if (!headers_sent()) {
		header ('Location: admin.php');
	exit;
	}
	else {
		print $admin_redirect;
	exit;
	}
	exit();
	}
}

?>