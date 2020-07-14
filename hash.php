<?php

  $hashtype = $_POST['hashtype'];
  $plaintext = $_POST['plaintext'];
  $starttime = microtime(true);

  switch( $hashtype )
  {
    case "md5": $hashresult = md5($plaintext);
      break;
    case "sha1": $hashresult = sha1($plaintext);
      break;
    case "sha256": $hashresult = hash("sha256",$plaintext);
      break;
    case "sha384": $hashresult = hash("sha384",$plaintext);
      break;
    case "sha512": $hashresult = hash("sha512",$plaintext);
      break;
    case "whirlpool": $hashresult = hash("whirlpool",$plaintext);
      break;
    case "snefru": $hashresult = hash("snefru",$plaintext);
      break;
    case "gost": $hashresult = hash("gost",$plaintext);
      break;
    case "mod10": $hashresult = generateModTen($plaintext);
      break;
    default:    $hashresult = "!!";
      break;
  }

  $endtime = microtime(true);
  $timediff = ($endtime - $starttime);

  echo json_encode(["hash"=>$hashresult,"time"=>$timediff]);

  function generateModTen($number)
  {
    $stack = 0;
    $number = str_split(strrev($number));

    foreach ($number as $key => $value)
    {
         if ($key % 2 == 0)
         {
             $value = array_sum(str_split($value * 2));
         }
         $stack += $value;
    }
    $stack %= 10;

    if ($stack != 0)
    {
         $stack -= 10;     $stack = abs($stack);
    }


    $number = implode('', array_reverse($number));
    $number = $number . strval($stack);

    return $number;
  }
