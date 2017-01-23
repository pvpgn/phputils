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
include("config.inc.php");

$login_redirect = "<meta http-equiv=refresh content=\"0; url=login_add.php\">";
$admin_redirect = "<meta http-equiv=refresh content=\"0; url=user.php\">";

session_start();
if(!session_is_registered('user'))
	if (!headers_sent()) {
		header ('Location: login_add.php');
	exit;
	}
	else {
		print $login_redirect;
	exit;
	}

$page = new page_handle();


include('adduser.php');
	

	


?>