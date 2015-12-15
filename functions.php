<?php

#Handle url arguments
function unJQSerialize($data) {
  $us = [];
  $data = explode("&", $data);
  
  for ($x = 0; $x < count($data); $x++) {
    $usR = explode("=", $data[$x]);
    $usT = $usR[0];
    $usD = $usR[1];
    $us[$usT] = $usD;
  }
  
  return $us;
}

#Arrays/Objects to strings
function jqSerialize($data) {
  $us = '';
  foreach ($data as $key => $value)
    $us .= '&' . $key . '=' . $value;
  
  return substr($us, 1);
}

#Check if a string ends with a substring
function endsWith($haystack, $needle) {
  $start = strlen($needle) * -1;
  return (substr($haystack, $start) === $needle);
}
