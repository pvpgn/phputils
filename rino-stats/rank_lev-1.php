<?php
//echo '</br>Update rank of solo,team and ffa mode depending of xp points';
//echo '</br>Fix server double rank values';
echo '</br>Rank users  with xp 0, only rank at most 1000 users';

$db = mysql_pconnect('localhost','root','miguel');

if(!$db)
{
echo 'no se puede conectar!!';
exit;
}
//actualiza rank solo
mysql_select_db('pvpgn');
$query='select * from record where w3xp_solo_level<1 order by w3xp_solo_xp desc limit 1000';
$result=mysql_query($query);
$registros=mysql_num_rows($result);
$i=0;
while ( $i<$registros)
{
	$uid=mysql_result($result,$i,'uid');
	$level=mysql_result($result,$i,'w3xp_solo_level');
	$rank=mysql_result($result,$i,'w3xp_solo_rank');
	
	$i++;
	if ($level<1) {$q2=mysql_query("update record set w3xp_solo_rank = 0 where uid=".$uid);}
	else{
	$q2=mysql_query("update record set w3xp_solo_rank = ".$i." where uid=".$uid);}
//echo "</br>".$uid." registro=".$i." level=".$level." rank=".$rank;
}


//actualiza rank team

$query='select * from record where w3xp_team_level<1 order by w3xp_team_xp desc limit 1000';
$result=mysql_query($query);
$registros=mysql_num_rows($result);

$i=0;
while ( $i<$registros)
{
	$uid=mysql_result($result,$i,'uid');
	$level=mysql_result($result,$i,'w3xp_team_level');
	$rank=mysql_result($result,$i,'w3xp_team_rank');
	
	$i++;
	if ($level<1) {$q2=mysql_query("update record set w3xp_team_rank = 0 where uid=".$uid);}
	else{
	$q2=mysql_query("update record set w3xp_team_rank = ".$i." where uid=".$uid);}
	//echo "</br>".$uid." registro=".$i." level=".$level." rank=".$rank;
	
}


//actualiza rank ffa

$query='select * from record where w3xp_ffa_level<1 order by w3xp_ffa_xp desc limit 1000';
$result=mysql_query($query);
$registros=mysql_num_rows($result);

$i=0;
while ( $i<$registros)
{
	$uid=mysql_result($result,$i,'uid');
	$level=mysql_result($result,$i,'w3xp_ffa_level');
	$rank=mysql_result($result,$i,'w3xp_ffa_rank');
	
	$i++;
	if ($level<1) {$q2=mysql_query("update record set w3xp_ffa_rank = 0 where uid=".$uid);}
	else{
	$q2=mysql_query("update record set w3xp_ffa_rank = ".$i." where uid=".$uid);}
	
}

echo "</br></br>Fixed!!.";


?>