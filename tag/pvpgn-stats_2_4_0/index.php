<HTML><HEAD>
<TITLE>Online Battle Zone - Ladders</TITLE>
<style type="text/css">
<!--
a:link {
	color: #cba300;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #cba300;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
-->
</style></HEAD>
<BODY bgColor=#000000 leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="themes/bnet/images/main/war3-human-ie.css" type=text/css rel=stylesheet>
<LINK href="themes/bnet/images/main/war3-ladder-ranking.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.2523" name=GENERATOR>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<style type="text/css">
<!--
.style2 {font-size: 8pt}
-->
</style>
<?php
// This is how we pull our URL from the "config.inc.php" and replace all refrences
// in this html file
require_once("config.inc.php");
?>

<SCRIPT language=JavaScript src="themes/bnet/images/main/layerFunctions.js"></SCRIPT>

<SCRIPT language=JavaScript src="themes/bnet/images/main/detection2.js"></SCRIPT>

<SCRIPT language=JavaScript src="themes/bnet/images/main/detection.js"></SCRIPT>

<DIV id=mouseTrap 
style="Z-INDEX: 50; VISIBILITY: hidden; WIDTH: 100%; POSITION: absolute; TEXT-ALIGN: center; height: 460px;"><a 
onMouseOver="javascript:hideLayer('gatewayMenu'); hideLayer('gameMenu'); hideLayer('sectionMenu'); hideLayer('mouseTrap');" 
href="http://myserver.com/gamestats/pvpgn/stats.php?game=&amp;type="><img 
height=100% src="themes/bnet/images/main/pixel.gif" width=100% border=0></a></DIV>
<TABLE class=mainTable height="100%" cellSpacing=0 cellPadding=0 width="100%" 
border=0>
  <TBODY>
  <TR height=75>
    <TD style="BACKGROUND-POSITION: left 50%; BACKGROUND-IMAGE: url(themes/bnet/images/main/left-bg.gif); BACKGROUND-REPEAT: repeat-"vAlign=top" colSpan=3>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" 
      background=themes/bnet/images/main/top-bg.gif border=0>
        <TBODY>
        <TR>
          <TD width=15><img height=75 src="themes/bnet/images/main/top-left.gif" 
          width=15></TD>
          <TD align=middle bordercolor="0">
            <table width="0%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="436" height="75" background="GS_Laddersnew.GIF"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" background="themes/bnet/images/main/GS_Ladders.gif">
                  <tr>
                    <td height="33" colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="65">&nbsp;</td>
                    <td><TABLE width=292 height="100%" border=0 cellPadding=0 cellSpacing=0>
  <TBODY>
  
  <TR>
    <TD vAlign=top width=111><DIV id=gameMenu 
                        style="Z-INDEX: 100; VISIBILITY: hidden; WIDTH: 111px; POSITION: absolute">
        <TABLE cellSpacing=0 cellPadding=0 width="100%">
          <TBODY>
            <TR>
              <TD class=headerOutline width="100%" 
                              bgColor=black><TABLE cellSpacing=0 cellPadding=0 
                              width="100%" border=0>
                  <TBODY>
                    <TR>
                      <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Warcraft II: BNE<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W2BN&type=0"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Normal</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W2BN&type=1"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Ladder</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Reign of Chaos<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=solo"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Solo</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=WAR3&type=team"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Team</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=WAR3&type=ffa"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>FFA</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Frozen Throne<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=solo"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Solo</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=team"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Team</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=ffa"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>FFA</A></SMALL></TD>
                    </TR>
                  </TBODY>
              </TABLE></TD>
            </TR>
          </TBODY>
        </TABLE>
      </DIV>
        <TABLE cellSpacing=0 cellPadding=7 width="100%" 
border=0>
          <TBODY>
            <TR>
              <TD><div align="center"><SMALL><A 
                              onmouseover="javascript:showLayer('gameMenu'); showLayer('mouseTrap');" 
                              href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=solo"><IMG 
                              height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                              border=0>Warcraft<IMG height=7 
                              src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                              border=0></A></SMALL></div></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
    <TD width=1><IMG height=22 src="themes/bnet/images/main/pixel.gif" 
                        width=1></TD>
    <TD vAlign=top width=89><DIV id=gatewayMenu 
                        style="Z-INDEX: 101; VISIBILITY: hidden; WIDTH: 89px; POSITION: absolute">
        <TABLE cellSpacing=0 cellPadding=0 width="100%">
          <TBODY>
            <TR>
              <TD class=headerOutline width="100%" 
                              bgColor=black><TABLE cellSpacing=0 cellPadding=0 
                              width="100%" border=0>
                  <TBODY>
                    <TR>
                      <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Starcraft<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=STAR&type=0"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Normal</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=STAR&type=1"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Ladder</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Broodwar<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=SEXP&type=0"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Normal</A></SMALL></TD>
                    </TR>
                    <TR>
                      <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=SEXP&type=1"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Ladder</A></SMALL></TD>
                    </TR>
                  </TBODY>
              </TABLE></TD>
            </TR>
          </TBODY>
        </TABLE>
      </DIV>
        <TABLE cellSpacing=0 cellPadding=7 width="100%" 
border=0>
          <TBODY>
            <TR>
              <TD><div align="center"><SMALL><A 
                              onmouseover="javascript:showLayer('gatewayMenu'); showLayer('mouseTrap');" 
                              href="

<?php
echo $ladderroot
?>

stats.php?game=SEXP&type=0"><IMG 
                              height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                              border=0>Starcraft<IMG height=7 
                              src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                              border=0></A></SMALL></div></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
    <TD width=1><IMG height=22 src="themes/bnet/images/main/pixel.gif" 
                        width=1></TD>
    <TD width=105 vAlign=top bordercolor="0"><DIV id=sectionMenu 
                        style="Z-INDEX: 100; VISIBILITY: hidden; WIDTH: 105px; POSITION: absolute">
        <TABLE cellSpacing=0 cellPadding=0 width="100%">
          <TBODY>
          
          <TR>
            <TD class=headerOutline width="100%" 
                              bgColor=black><TABLE cellSpacing=0 cellPadding=0 
                              width="100%" border=0>
                <TBODY>
                  <TR>
                    <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Diablo<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                  </TR>
                  <TR>
                    <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=DRTL&type=0"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Ladder</A></SMALL></TD>
                  </TR>
                  <TR>
                    <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Diablo II<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                  </TR>
                  <TR>
                    <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=D2DV&type=SC"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Normal</A></SMALL></TD>
                  </TR>
                  <TR>
                    <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=D2DV&type=HC"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>HardCore</A></SMALL></TD>
                  </TR>
                  <TR>
                    <TD valign="middle" align="center" class=menuHeader><SMALL><Strong><A class=button><IMG 
                                height=16 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Diablo II: LOD<IMG height=7 
                                src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                                border=0></A></strong></SMALL></TD>
                  </TR>
                <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=D2XP&type=SC"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>Normal</A></SMALL></TD>
                </TR>
                <TR>
                  <TD class=menuHeader 
                                style="TEXT-ALIGN: center"><SMALL><A 
                                class=button 
                                href="

<?php
echo $ladderroot
?>

stats.php?game=D2XP&type=HC"><IMG 
                                height=7 src="themes/bnet/images/main/pixel.gif" width=3 
                                border=0>HardCore</A></SMALL></TD>
                </TR>
                </TBODY>
            </TABLE></TD>
          </TR>
          </TBODY>
        </TABLE>
      </DIV>
        <TABLE cellSpacing=0 cellPadding=7 width="100%" 
border=0>
          <TBODY>
            <TR>
              <TD><div align="center"><SMALL><A 
                              onmouseover="javascript:showLayer('sectionMenu'); showLayer('mouseTrap');" 
                              href="http://gameserver.solo.by/gamestats/pvpgn/D2XP_ladder.php"><IMG 
                              height=7 src="themes/bnet/images/main/pixel.gif" width=3
                              border=0>Diablo<IMG height=7
                              src="themes/bnet/images/main/pulldown-arrow.gif" width=11 
                              border=0> </A></SMALL></div></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
  </TR>
  <TR>
    <TD width=110><IMG height=4 src="themes/bnet/images/main/pixel.gif" 
                        width=111></TD>
    <TD width=1><IMG height=4 src="themes/bnet/images/main/pixel.gif" 
                        width=1></TD>
    <TD width=89><IMG height=4 src="themes/bnet/images/main/pixel.gif" 
                        width=89></TD>
    <TD width=1><IMG height=4 src="themes/bnet/images/main/pixel.gif" 
                        width=1></TD>
    <TD width=105 bordercolor="0"><IMG height=4 src="themes/bnet/images/main/pixel.gif" 
                        width=105></TD>
  </TR>
  
                    </TABLE></td>
                    </tr>
                </table></td>
              </tr>
            </table>
            </div></TD>
          <TD width=15><IMG src="themes/bnet/images/main/top-right.gif" 
          width=15 height=75 border="0"></TD>
      </TR></TABLE></TD></TR>
  <TR>
    <TD 
    style="BACKGROUND-POSITION: left 50%; BACKGROUND-IMAGE: url(themes/bnet/images/main/left-bg.gif); BACKGROUND-REPEAT: repeat-y" 
    width=5><IMG src="themes/bnet/images/main/pixel.gif" width=5 height=1 border="0"></TD>
    <TD vAlign=top align=middle width="100%"><div align="center">
      <p>&nbsp;</p>
      <table width="100%" height="370" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" height="83"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=W2BN&type=0"><img src="themes/bnet/images/main/BNE-logo.gif" width="227" height="71" border="0"></a></div></td>
          <td><div align="center"></div></td>
          <td width="33%"><div align="center"><a href="stats.php?game=DRTL&type=0"><img src="themes/bnet/images/main/D1-logo.gif" width="202" height="56" border="0"></a></div></td>
        </tr>
        <tr>
          <td width="33%" rowspan="2"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=WAR3&type=solo"><img src="themes/bnet/images/main/W3-logo.gif" width="191" height="94" border="0"></a></div></td>
          <td height="72" valign="top"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=STAR&type=0"><img src="themes/bnet/images/main/SC-logo.gif" width="235" height="37" border="0"></a></div></td>
          <td width="33%" rowspan="2"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=D2DV&type=SC"><img src="themes/bnet/images/main/D2-logo.gif" width="184" height="80" border="0"></a></div></td>
        </tr>
        <tr>
          <td valign="bottom"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=SEXP&type=0"><img src="themes/bnet/images/main/SCX-logo.gif" width="241" height="59" border="0"> </a></div></td>
        </tr>
        <tr>
          <td width="33%" height="108"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=W3XP&type=solo"><img src="themes/bnet/images/main/W3X-logo.gif" width="185" height="94" border="0"></a></div></td>
          <td><div align="center">
            </div></td>
          <td width="33%"><div align="center"><a href="

<?php
echo $ladderroot
?>

stats.php?game=D2XP&type=SC"><img src="themes/bnet/images/main/D2X-logo.gif" width="183" height="106" border="0"></a></div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div></TD>
    <TD width=5 background=themes/bnet/images/main/right-bg.gif><IMG 
      src="themes/bnet/images/main/pixel.gif" width=5 height=1 border="0"></TD>
  </TR>
  <TR>
    <TD colSpan=3 
    vAlign=bottom 
    style="BACKGROUND-POSITION: left 50%; BACKGROUND-IMAGE: url(themes/bnet/images/main/left-bg.gif); BACKGROUND-REPEAT: repeat-y">      <div align="center">
      <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr>
          <td width="50%"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="0">
            <tr>
              <td width="32"><a href="
				<?php
			  		echo $homepage
				?>
			  "><img src="themes/bnet/images/main/arrow-left.gif" width="32" height="52" border="0"></a></td>
              <td background="themes/bnet/images/main/bot-left-bg.gif">
			  <table width="120" height="100%"  border="0" cellpadding="0" cellspacing="0">
                <TR>
                  <TD width="120"><SMALL><BR>
                        <A href="
							<?php
								echo $homepage
							?>
						">Return to Home Page </A></SMALL></TD>
                </TR>
              </table></td>
              <td width="90" background="themes/bnet/images/main/left-logo.GIF">&nbsp;</td>
            </tr>
          </table></td>
          <td width="117" bordercolor="0"><p><a href="http://www.blizzard.com"><img src="themes/bnet/images/main/blizzlogo.gif" width="117" height="52" border="0"></a></p>
            </td>
          <td width="50%" bordercolor="0"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="90" background="themes/bnet/images/main/right-logo.GIF">&nbsp;</td>
              <td background="themes/bnet/images/main/bot-right-bg.gif">&nbsp;</td>
              <td width="15"><img src="themes/bnet/images/main/bot-right.gif" width="15" height="52" border="0"></td>
            </tr>
          </table></td>
          </tr>
      </table>
    </div></TD>
  </TR></TBODY></TABLE></BODY></HTML>
