<?php
// ------------------------------------------------------------------------------- //
//                                                                                 //
//                       The Player vs Player Gaming Network                       //
//                       Battle.net chat bot protocol parser                       //
//                                                                                 //
//                             Copyright (C) 2005 U-238                            //
//                                                                                 //
// ------------------------------------------------------------------------------- //

class bnbot_protocol_parse {
    function bnbot2array($raw_protocol) {
        $output = array();
        $linenum = 0;
        foreach (explode("\r\n",$raw_protocol) as $line) {
            $inquotes = false;
            $stage = 0;
            $line = trim($line);
            if ($line == "") continue;
            for ($x=0;$x<strlen($line);$x++) {
                $strip = false;
                if ($stage == 4 && $output[$linenum][0] == '1005') {

                }
                if ($line{$x} == ' ' && !$inquotes) {
                    $stage++;
                } elseif ($line{$x} == '"') {
                    if ($stage == 4 && $output[$linenum][0] == '1005') {
                        $strip = 4;
                        $inquotes = true;
                        if (isset($output[$linenum][$stage])) {
                            $output[$linenum][$stage] .= $line{$x};
                        } else {
                            $output[$linenum][$stage] = $line{$x};
                        }
                    } elseif ($stage == 2 && strstr($output[$linenum][0],'101')) {
                        $strip = 2;
                        $inquotes = true;
                        if (isset($output[$linenum][$stage])) {
                            $output[$linenum][$stage] .= $line{$x};
                        } else {
                            $output[$linenum][$stage] = $line{$x};
                        }
                    } else {
                        if ($inquotes)
                            $inquotes = false;
                        else
                            $inquotes = true;
                    }
                } else {
                    if (isset($output[$linenum][$stage])) {
                        $output[$linenum][$stage] .= $line{$x};
                    } else {
                        $output[$linenum][$stage] = $line{$x};                
                    }
                }
            }
            if ($strip) {
                $output[$linenum][$strip] = substr($output[$linenum][$strip],1,-1);
            }
            $linenum++;
        }
        return $output;
    }
}


// For testing purposes

/*
$text = "1019 ERROR \"Chatting with this\" game is restricted to the channels listed in the channel menu.\"\r\n";
$text .= "1018 INFO \"Last logon: Mon \"Jan 17  8:43 AM\"\r\n";
$text .= "1005 TALK OceanBorne@Lordaeron 0000 \"*sn\"ezze*\"\r\n";
$text .= "1005 TALK thingamabob2500 0000 \"*explodes*\"\r\n";
$text .= "1003 LEAVE sethlovesgirls@Lordaeron 0000\r\n";
$text .= "1002 JOIN Big_Bad_Billy@Azeroth 0000 [WAR3]\r\n";
$text .= "1002 JOIN FdS)Bot 0010 [CHAT]\r\n";
$text .= "1004 WHISPER FdS)Bot 0000 \"-Blip-\"\r\n";
$text .= "1003 LEAVE FdS)Bot 0010\r\n";
$text .= "1005 TALK Big_Bad_Billy@Azeroth 0000 \"can someone here make hero wars?\"\r\n";
$text .= "1005 TALK Big_Bad_Billy@Azeroth 0000 \"i got fire wall\"\r\n";

echo "<pre>".$text."\r\n\r\n</pre>";

$blah = new bnbot_protocol_parse;
$array = $blah->bnbot2array2($text);

foreach ($array as $line) {
    switch (intval($line[0])) {
        case 2000:
            break;
    
        case 1019:
            echo "<font color=\"#FF0000\">".$line[2]."</font><br>\n";
            break;
    
        case 1018:
            echo "<font color=\"#0000FF\">".$line[2]."</font><br>\n";
            break;

        case 1005:
            echo "&lt;".$line[2]."&gt; ".$line[4]."<br>\n";
            break;

        case 1004:
            echo "<font color=\"#555555\">&lt;From: ".$line[2]."&gt; ".$line[4]."</font><br>\n";
            break;

        case 1003:
            echo "<font color=\"#00AA00\">&lt;-- ".$line[2]." has left the channel</font><br>\n";
            break;
        
        case 1002:
            echo "<font color=\"#00AA00\">--&gt; ".$line[2]." has joined the channel</font><br>\n";
            break;

        default:
            echo "Unknown message type ".$line[0]."<br>\n";
            break;
    }
}
*/
?>
