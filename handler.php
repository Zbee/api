<?php
#Specifying that the return is JSON
header('Content-Type: application/json');

#Include functions
require('functions.php');

#Require a key (private endpoints)
function requireKey() {
  global $argumentsU;
  global $arguments;
  if (!array_key_exists("key", $arguments))
    throw new Exception(
      'Key required to access this private endpoint (arguments: ' . $argumentsU
        . ')'
    );
  if (strlen($arguments["key"]) != 20)
    throw new Exception(
      'Key provided is of an incorrect length (' . $arguments["key"] . ' ('
        . strlen($arguments["key"]) . '))'
    );
}

#Require initial data
function requirePost($fields) {
  foreach ($fields as $field => $type) {
    $type = strtolower($type);
    if (!array_key_exists($field, $_POST))
      throw new Exception(
        'Additional information required ((' . $type . ') ' . $field . ') ('
          . jqSerialize($_POST) . ')'
      );
    if (gettype($_POST[$field]) != $type)
      throw new Exception(
        'Additional information provided included incorrect typing ((' . $type
          . ') ' . $field . ' given type ' . gettype($_POST[$field]) . ')'
      );
  }
}

#Supported endpoints
$endpoints = [
  'school' => ['status', 'grades']
];

#Default variables
$got = 'data';
$endpoint = '';

#Standardising the URL
$explodes = count(explode('/', 'https://api.zbee.me'));
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = trim($url, '/');
$url = $url = explode('/', $url);

for ($x = 0; $x < $explodes; $x++) #Cutting out the base API url
  array_shift($url);

#Sanitize URL
$url = strip_tags(str_replace('\'', '&#39;', implode('/', $url)));
$url = strtolower($url);

#Separate URL from arguments
$url = explode('?', $url);
$argumentsU = array_key_exists(1, $url) ? $url[1] : '';
$arguments = strlen($argumentsU) > 0 ? unJQSerialize($argumentsU) : [];
$url = $url[0];

#URL array with endpoint information
$urlFind = explode('/', $url);

#Checking that the given endpoint exists
try {
  #If parent endpoint does not exist
  if (!array_key_exists($urlFind[0], $endpoints))
    throw new Exception('No such endpoint (' . $urlFind[0] . ')');

  #Endpoint with data
  if (count($urlFind) == 3) {
    #If child endpoint doesn't exist
    if (!in_array($urlFind[2], $endpoints[$urlFind[0]]))
      throw new Exception(
        'No such subsequent endpoint ('. $urlFind[0] . '/{data}/' . $urlFind[2]
        . ')'
      );
    $data = $urlFind[1];
    require($urlFind[0] . '/' . $urlFind[2] . '.php');
  #Endpoint without data
  } elseif (count($urlFind) == 2) {
    #If child endpoint doesn't exist
    if (!in_array($urlFind[1], $endpoints[$urlFind[0]]))
      throw new Exception(
        'No such subsequent endpoint ('. $urlFind[0] . '/' . $urlFind[1] . ')'
      );
    require($urlFind[0] . '/' . $urlFind[1] . '.php');
  }

  #Return output from endpoint
  http_response_code(200);
  echo json_encode($echo);
#If endpoint could not be found, error
} catch (Exception $e) {
  http_response_code(400);
  echo json_encode(['error' => $e->getMessage()]);
  $got = 'error';
}
