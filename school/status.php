<?php
#Does not support special statuses

#Supported school systems
$supported = [
  'csec' => 1465,
  'doherty' => 462,
  'liberty' => 160,
  'ppcc' => 475,
  'vista' => 187,
  'cocsd3' => 518,
  'cocsd11' => 462,
  'cocsd20' => 160,
  'cocsd49' => 187
];

#Bring in phpQuery
require('/var/www/api/libs/phpQuery.php');

#Convert all UTF8 characters to HTML entitites
function handleUTF8 ($code) {
  return preg_replace_callback('/[\x{80}-\x{10FFFF}]/u', function($match) {
    list($utf8) = $match;
    $entity = mb_convert_encoding($utf8, 'HTML-ENTITIES', 'UTF-8');
    return $entity;
  },
  $code);
}

#Get the status of a given school system
function getStatus ($key) {
  #Load FlashAlert page for school system
  global $supported;
  $id = $supported[$key];
  $page = file_get_contents('https://www.flashalert.net/news.html?id=' . $id);

  #Load FlashAlert page into phpQuery
  phpQuery::newDocument($page);

  #Get the status of the school system
  $status = pq('.BoxContent:first-of-type');
  $status = pq($status)->html();
  #Remove garbled content, standardise output
  $status = strtolower(handleUTF8(trim($status)));

  #Check for status of school system
  if (strpos($status, 'close') !== false) {
    $status = 'closed';
  } elseif (strpos($status, 'delay') !== false
    || strpos($status, 'late') !== false) {
    $status = 'delayed';
  } else {
    $status = 'normal';
  }

  return $status;
}

#If specified school system is not supported
if (!array_key_exists($data, $supported))
  throw new Exception('School/District not supported (' . $data . ')');

#Get the status of the school system
$status = getStatus($data);

#Return the status of the school system
$echo = [
  'status' => $status,
  'special' => false
];
