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
// Author from 2.3.20: Snaiperx (http://www.rino.com.co/)
// Author from 2.3.16: STORM (http://www.stormzone.ru/)
// Tanzania theme author: Tanzania (tanzania@gmx.net)
// ----------------------------------------------------------------------

error_reporting (E_ERROR | E_WARNING | E_PARSE);
require_once("includes/page_handler.php");
require_once("includes/pvpgn_stats.php");
include_once("config.inc.php");

$php_ver = PHP_VERSION;
$php_ver = explode(".",$php_ver);
if(($php_ver[0] >= 4 && $php_ver[1] == 0)) {
	print "<strong>Warning:</strong> Recomend upgrading to PHP 4.3.x<br />";
	$POST = &$HTTP_POST_VARS;
	$GET = &$HTTP_GET_VARS;
}

else {
	$POST = &$_POST;
	$GET = &$_GET;
}

foreach(array_keys($GET) as $key) {
	$$key = $GET[$key];
}

$stats = new pvpgn_stats();
$page = new page_handle();

$menu_games = array("theme_file"=>"menu_entry.html",
	array("name"=>"Starcraft","code"=>"STAR","type"=>"0"),
	array("name"=>"Starcraft: Broodwar ","code"=>"SEXP","type"=>"0"),
	array("name"=>"Diablo","code"=>"DRTL","type"=>"0"),
	array("name"=>"Diablo 2","code"=>"D2DV","type"=>"SC"),
	array("name"=>"Diablo 2 LOD","code"=>"D2XP","type"=>"SC"),
	array("name"=>"Warcraft 2 BNE","code"=>"W2BN","type"=>"0"),
	array("name"=>"Warcraft III:ROC","code"=>"WAR3","type"=>"solo"),
	array("name"=>"Warcraft III: Frozen Throne","code"=>"W3XP","type"=>"solo"));

$user_search = $POST['user_search'];
$user_method = $POST['user_method'];
$current_page = $GET['current_page'];

if(!isset($game) || $game == "") {
	$game = $default_game;
	$type = $default_type;
}

$menu_types = array(
	"STAR"=>array(
	 array("name"=>"Normal","type"=>0,"game"=>"STAR"),
	array("name"=>"Ladder","type"=>1,"game"=>"STAR")
		),
	"SEXP"=>array(
		array("name"=>"Normal","type"=>0,"game"=>"SEXP"),
		array("name"=>"Ladder","type"=>1,"game"=>"SEXP")),
	"DRTL"=>array(),
	"D2DV"=>array(
		array("name"=>"Normal","type"=>"SC","game"=>"D2DV"),
		array("name"=>"Hardcore","type"=>"HC","game"=>"D2DV")),
	"D2XP"=>array(
		array("name"=>"Normal","type"=>"SC","game"=>"D2XP"),
		array("name"=>"Hardcore","type"=>"HC","game"=>"D2XP")),
	"W2BN"=>array(
		array("name"=>"Normal","type"=>0,"game"=>"W2BN"),
		array("name"=>"Ladder","type"=>1,"game"=>"W2BN")),
	"WAR3"=>array(
		array("name"=>"Solo Ladder","type"=>"solo","game"=>"WAR3"),
		array("name"=>"Team Ladder","type"=>"team","game"=>"WAR3"),
		array("name"=>"FFA Ladder","type"=>"ffa","game"=>"WAR3")),
	"W3XP"=>array(
		array("name"=>"Solo Ladder","type"=>"solo","game"=>"W3XP"),
		array("name"=>"Team Ladder","type"=>"team","game"=>"W3XP"),
		array("name"=>"FFA Ladder","type"=>"ffa","game"=>"W3XP")
		)
);

$sub_menu = $menu_types[$game];
$sub_menu['theme_file'] = "submenu_entry.html";
$game_type = $game."_".$type."_";

if(!isset($sortBy)) {
	if(strstr($game_type,"SEXP_1")||strstr($game_type,"STAR_1")) {
		$sortBy = $game_type."rank";
	}
	else if(strstr($game_type,"DRTL")) {
		$sortBy = $game_type."level";
	}
	else if(strstr($game_type,"WAR3_0_")) {
		$sortBy = $game."experience";
	}
	else if(strstr($game_type,"WAR3")) {
		$sortBy = $game_type."rank";
	}
	else if(strstr($game_type,"W3XP")) {
		$sortBy = $game_type."rank";
	}
	else if(strstr($game,"D2")) {
		$sortBy = "experience";
	}
	else {
		$sortBy = $game_type."wins";
	}
}

if(!isset($sort_direction)) {
	if(strstr($sortBy,"rating")||strstr($sortBy,"experience")) {
		$sort_direction = "DESC";
	}
	else if(strstr($sortBy,"rank")) {
		$sort_direction = "ASC";
	}
	else {
		$sort_direction = "DESC";
	}
}

if(!isset($current_page)) {
	$current_page = 0;
}

$page_num = $current_page * $page_max;

if($action == "search") {
	if($user_method == "contains") {
		$user_search = "%".$user_search."%";
	}
	$stats->user_search($user_search,$game_type);
	}
	else if(!isset($user)) {
		if(strstr($game_type,"D2")) {
			$stats->d2ladder_update();
			$stats->load_d2stats($game_type,$sortBy,$sort_direction,$page_num,$page_max);
	}
	else {
		$stats->load_stats($game_type,$sortBy,$sort_direction,$page_num,$page_max);
	}
}

$max_pages=(ceil(($stats->user_count()) / $page_max)) - 1;
if($current_page > 0) {
	$control_first = " <a class=button href=\"stats.php?game=$game&amp;type=$type&amp;sortBy=$sortBy&amp;current_page=0\"> ";
	$control_prev = "  <a class=button href=\"stats.php?game=$game&amp;type=$type&amp;sortBy=$sortBy&amp;current_page=".($current_page - 1)."\">   ";
  $control_prev_text = "Prev&nbsp;Page"; 
}

if($current_page < $max_pages) {
	$control_next = " <a class=button href=\"stats.php?game=$game&amp;type=$type&amp;sortBy=$sortBy&amp;current_page=".($current_page + 1)."\"> Next&nbsp;Page";
	$control_last = "  <a class=button href=\"stats.php?game=$game&amp;type=$type&amp;sortBy=$sortBy&amp;current_page=$max_pages\">";
}

$control_page = "Page: ".($current_page+1)." of ".($max_pages+1);

if(!isset($user)||$user=="") {
	$display_stats = $stats->get_stats();
	  if ($display_stats[0]['username']== 'NO SUCH USER'){
	    $display_stats = "<tr><td bgcolor='#000000' colspan=\"9\"><center><table><tr><td><IMG height=18 src=\"themes/bnet/images/w3tft/unknown.gif\"  width=26></td><td><small>No such user</td></tr></table></small></td></tr>";}
		else
		if(count($display_stats) == 0)
			$display_stats = "<tr><td bgcolor='#111111' colspan=\"9\"><small><center>No users for this game</small></td></tr>";
		else
    	   
    	    $display_stats['theme_file'] = $game_type."entry.html";
			$layout_file = "stats.layout.html";
			$page_data = array("content"=>$display_stats,
				"game_header"=>array(0=>"","theme_file"=>$game_type."main.html"),
				"game"=>$game,
				"type"=>$type,
				"stats_version"=>$stats_version,
				"site_theme"=>$site_theme,
				"menu"=>$menu_games,
				"submenu"=>$sub_menu,
				"control_first"=>$control_first,
				"control_prev"=>$control_prev,
				"control_next"=>$control_next,
				"control_last"=>$control_last,
				"control_page"=>$control_page,
				"control_prev_text"=>$control_prev_text,
				"homepage"=>$homepage,
				"ladderroot"=>$ladderroot
			);
}
else {
	$stats->load_user_stats($user,$game_type);
	$display_stats = $stats->get_stats();
	$display_stats['theme_file'] = $game."_user.html";
	$layout_file = "user.info.layout.html";
	$page_data = array("stats_version"=>$stats_version,
	"site_theme"=>$site_theme,"game_search"=>$game_type,"content"=>$display_stats,
	"menu"=>$menu_games,"submenu"=>$sub_menu);

}

$page->setup($site_theme,$layout_file,$page_data);
$page->parse();
print $page->fetch();
$stats->shutdown();

?>