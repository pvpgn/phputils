<?php
// ------------------------------------------------------------------------------- //
//                                                                                 //
//                       The Player vs Player Gaming Network                       //
//                     Battle.net chat bot protocol PHP library                    //
//                                                                                 //
//                             Copyright (C) 2005 U-238                            //
//                                                                                 //
// ------------------------------------------------------------------------------- //

class bnbot {
    var $fp;
    var $errno;
    var $errstr;
    var $whisper;

    function connect($host,$username,$password,$port=6112,$timeout=2) {
        if (isset($this->fp))
            return -3;

        $this->fp = fsockopen($host,$port,$this->errno,$this->errstr,$timeout);
        if (!$this->fp)
            return -2;

        fwrite($this->fp,"\x03");

        $this->waitfor('Username:');
        fwrite($this->fp,$username."\r\n");

        $this->waitfor('Password:');
        fwrite($this->fp,$password."\r\n");

        $x=0;
        do {
            $buffer = fread($this->fp,4096);
            $x++;
        } while (!preg_match("/2010|failed/i",$buffer));

        if (strstr($buffer,'2010')) {
            return 0;
        } else {
            fclose($this->fp);
            return -1;
        }
    }

    function sendcmd($cmd) {
        if ($cmd == 'help help') {
            return "1018 INFO \"/help [<command>] - does this\"\r\n";
        }
        fwrite($this->fp,"/".$cmd."\r\n/help help\r\n");
        $content = '';
        do {
            $buffer = fread($this->fp,4096);
            $content .= $buffer;
        } while (!strstr($buffer,'/he') && !strstr($buffer,'1018 INFO "/help [<command>] - does this"'));
        return substr($content,0,-43);;
    }
    
    function sendmsg($raw) {
        if (isset($this->fp)) {
            if (isset($this->whisper))
                fwrite($this->fp,"/w ".$this->whisper." $raw\r\n");
            else
                fwrite($this->fp,"$raw\r\n");
        }
    }

    function setwhisper($new) {
        $this->whisper = $new;
    }
    
    function unsetwhisper() {
        unset($this->whisper);
    }

    function sendraw($raw) {
        fwrite($this->fp,$raw);    
    }

    function getraw() {
        return fread($this->fp,4096);
    }
    
    function connected() {
        return isset($this->fp);
    }

    function disconnect() {
        fwrite($this->fp,"/quit\r\n");
        fclose($this->fp);
        unset($this->fp);
    }

    function waitfor($text) {
        $x=0;
        do {
            $buffer = fread($this->fp,4096);
            $x++;
        } while (!strstr($buffer,$text));
    }

    function geterrno() {
        return $this->errno;
    }

    function geterrstr() {
        return $this->errstr;
    }
}
?>
