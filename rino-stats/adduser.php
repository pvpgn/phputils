<?php
//create short names for variables
@ $user_name = $HTTP_POST_VARS['user_name'];
@ $user_pass = $HTTP_POST_VARS['user_pass'];
@ $user_pass1 = $HTTP_POST_VARS['user_pass1'];
@ $user_email = $HTTP_POST_VARS['user_email'];
$error="false";
if(empty($user_name)||empty($user_pass))
{
//Visitor needs to enter a name and password
?>


<html>
<head>
<title>Nuevo Usuario Bnet RINO</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="themes/[[site_theme]]/main.css" rel="stylesheet" type="text/css" />
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
<body><center>
<h1></h1>
<div style="font-size: 2em;">Nuevo Usuario Bnet RINO</div><br />
[ <a href="login_add.php?logout=1">Logout</a> ]
<form action="adduser.php" method="post">
<table border="0">
<tr>
<td>Nickname</td>

<td><input type="text" name="user_name" maxlength="13" size="13"><br /></td>
</tr>
<tr>
<td>Password</td>
<td> <input type="password" name="user_pass" maxlength="30" size="30"><br /></td>
</tr>
<tr>
<td>Confirm Password</td>
<td> <input type="password" name="user_pass1" maxlength="30" size="30"><br /></td>
</tr>
<tr>
<td>E-mail</td>
<td> <input type="text" name="user_email" maxlength="60" size="30"><br></td>
</tr>
<tr>

</tr>
<tr>
<td colspan="2"><input type="submit" value="Agregar"></td>
</tr>
</table>
</form><br><br><br><br>
<div align="center">RINO Add user System  by <a href="mailto:snaiperx@tutopia.com">Snaiperx</a><br /><br />
<small>
<a href="http://www.battle.net" target="_blank">Battle.net</a><br />
1996 - 2003 Blizzard Entertainment. All rights reserved. Battle.net and Blizzard Entertainment are trademarks or registered trademarks of Blizzard Entertainment in the U.S. and/or other countries.
</small>





<?php
}
else{
include("bnet_pass.php");


if ($user_pass == $user_pass1) {
		if (strlen($user_pass) > 2) {
			$passhash = bnet_pass($user_pass);
		} else {
			//print "error";
			$error="true";
			include("adduser.html");
			?>	
 <SCRIPT>
alert('Your password must be at least 3 characters long.');
</SCRIPT> 
<?php 
		}
	} else {
		
		$error="true";
		include("adduser.html");
		//error(0,__PASSMISMATCH,"");
					?>	
 <SCRIPT>
alert('The password and repeated password do not match.');
</SCRIPT> 
<?php 
	}

if ($error=="false"){

@ $db = mysql_pconnect('localhost', 'root', 'miguel');
if (!$db)
{
echo 'Error: Could not connect to database. Please try again later.';
exit;
}
mysql_select_db('pvpgn');

function AddNew($data, $table){
unset($keys, $values);
foreach($data as $key => $val){
    //$val = str_replace("'", "''", $val);
    if (isset($keys)){
        $keys .= ",`{$key}`";
           $values .= ",'{$val}'";
       }else {
        $keys = "`{$key}`";
           $values = "'{$val}'";
       }
   }

if (!isset($keys)) return 'Parameter Error!';
if (mysql_query("INSERT INTO `{$table}`({$keys}) VALUES({$values})")){
    return true;
   }else {
    //echo mysql_error();
    return false;
   }
}
$query="select acct_username  from bnet where acct_username=\"".$user_name."\" order by acct_username desc limit 1000";
$result=mysql_query($query);
$registros=mysql_num_rows($result);

//echo $registros;
if ($registros==0){

$rs = mysql_query("SELECT MAX(`uid`) FROM `bnet`");
if ($row = mysql_fetch_row($rs)){
unset($data);
   $data['uid'] = $row[0] + 1;
   $data['acct_userid'] = $data['uid'];
   $data['acct_username'] = $user_name;
   $data['acct_passhash1'] = bnet_pass($user_pass);
   $data['acct_email'] = $user_email;
   AddNew($data, 'bnet'); // u can write a commen SQL Insert Query here!
                          // I just want to make the code more easy to read.

 
  include("adduser.html");
 ?>
 
 
 
 


 <SCRIPT>
alert('Usuario Agregado');
</SCRIPT>  

<?php
//echo "Usuario Agregado!";

}
}else { include("adduser.html");
	
?>	
 <SCRIPT>
alert('Usuario ya existe');
</SCRIPT> 
<?php 
}}

}
?>
</div>
</body>
</html>