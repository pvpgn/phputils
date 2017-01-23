<?php
function hash_init(&$hash)
{
   $hash[0] = 0x67452301;
   $hash[1] = 0xefcdab89;
   $hash[2] = 0x98badcfe;
   $hash[3] = 0x10325476;
   $hash[4] = 0xc3d2e1f0;
}

function hash_set_16(&$dst, &$src, $base, $count){
   for ($pos=$base,$i=0; $i<16; $i++){
    $dst[$i] = 0;
    $count += $base;
    if ($pos<$count) $dst[$i] |= ord($src[$pos++]);
    if ($pos<$count) $dst[$i] |= ord($src[$pos++])<<8;
    if ($pos<$count) $dst[$i] |= ord($src[$pos++])<<16;
    if ($pos<$count) $dst[$i] |= ord($src[$pos++])<<24;
   }
   return $dst;
}

function ROTL32($x, $n){
   return ($x >> (32 - $n)) & ((0x80000000 >> (31 - $n)) ^ 0xFFFFFFFF) | ($x << $n);
}

function do_hash(&$hash, &$tmp){
   for ($i=0; $i<64; $i++)
    $tmp[$i+16] = ROTL32(1 ,$tmp[$i] ^ $tmp[$i+8] ^ $tmp[$i+2] ^ $tmp[$i+13]);

   $a = $hash[0];
   $b = $hash[1];
   $c = $hash[2];
   $d = $hash[3];
   $e = $hash[4];

   for ($i=0; $i<20*1; $i++){
       $g = $tmp[$i] + ROTL32($a,5) + $e + (($b & $c) | (($b ^ 0xFFFFFFFF) & $d)) + 0x5a827999;
    $e = $d;
    $d = $c;
    $c = ROTL32($b,30);
    $b = $a;
    $a = $g;
   }

   for (; $i<20*2; $i++){
    $g = ($d ^ $c ^ $b) + $e + ROTL32($g,5) + $tmp[$i] + 0x6ed9eba1;
    $e = $d;
    $d = $c;
    $c = ROTL32($b,30);
    $b = $a;
    $a = $g;
   }

   for (; $i<20*3; $i++){
    $g = $tmp[$i] + ROTL32($g,5) + $e + (($c & $b) | ($d & $c) | ($d & $b)) - 0x70e44324;
    $e = $d;
    $d = $c;
    $c = ROTL32($b,30);
    $b = $a;
    $a = $g;
   }

   for (; $i<20*4; $i++){
    $g = ($d ^ $c ^ $b) + $e + ROTL32($g,5) + $tmp[$i] - 0x359d3e2a;
    $e = $d;
    $d = $c;
    $c = ROTL32($b,30);
    $b = $a;
    $a = $g;
   }

   $hash[0] += $g;
   $hash[1] += $b;
   $hash[2] += $c;
   $hash[3] += $d;
   $hash[4] += $e;
}


function bnet_hash(&$hashout, $data){
   if ($data == ""){
       return -1;
   }else {
       $size = strlen($data);
   }
   hash_init($hashout);
   $base = 0;
   for ($i=0; $i<80; $i++){
       $tmp[$i] = 0;
   }

   while ($size > 0){
 if ($size > 64) $inc = 64;
 else $inc = $size;

    hash_set_16($tmp, $data, $base, $inc);

    do_hash($hashout, $tmp);

    $size -= $inc;
    $base += $inc;
}
   return 0;
}

function bnet_pass($pass){
bnet_hash($hash, $pass);
   return sprintf("%08x%08x%08x%08x%08x",$hash[0],$hash[1],$hash[2],$hash[3],$hash[4]);
}


/*
* Sample To Use This Function
*
* User The $hashcode To Check the User Input Pass Is Right!
* Or Can Change The Player Password On PHP Web Page!
* User This HashCode Like Use MD5 Hash.


$hashcode = bnet_pass("rino2004");
echo $hashcode;*/
?>