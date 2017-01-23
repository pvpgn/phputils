<?php
include("bnbot.class.php");
include("bnbot_protocol_parse.class.php");

// PvPGN login information
$host = "localhost";
$port = 6112;
$username = "Admin";
$password = "password";

// Command to execute (without /)
$cmd = "users";

$parser = new bnbot_protocol_parse;
$bot = new bnbot;
echo "<strong>Connecting to ".$host.":".$port."...</strong><br>\r\n";

switch ($bot->connect($host,$username,$password,$port)) {
    case -3:
        echo "You are already connected<br>\r\n";
        break;

    case -2:
        echo "Could not connect to the server<br>\r\n";
        echo "Reason: (".$bot->geterrno().") ".$bot->geterrstr()."<br>\r\n";
        break;

    case -1:
        echo "Authentication failed.  Please check your username and password and try again<br>\r\n";
        break;
    
    case 0:
        echo "<strong>Connected.  Logged in as \"".$username."\".</strong><br>\r\n";
        echo "<strong>Sending command /".$cmd."...</strong><br>\r\n";
        $output_raw = $bot->sendcmd($cmd);
        echo "<strong>Parsing output...</strong><br>\r\n";
        $output_array = $parser->bnbot2array($output_raw);
        foreach ($output_array as $line) {
            switch (intval($line[0])) {
                case 1019:
                    echo "<font color=\"#FF0000\">Error: ".$line[2]."</font><br>\n";
                    break;
                case 1018:
                    echo "<font color=\"#0000FF\">".$line[2]."</font><br>\n";
                    break;
                default:
                    break;
            }
        }
        $bot->disconnect();
        echo "<strong>Disconnected.</strong><br>\r\n";
        break;
}
?>
