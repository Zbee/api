<?php
#Include passwords and keys
require('_secret_keys.php');

#Include database abstraction
require('vendor/mikehenrty/thin-pdo-wrapper/src/PDOWrapper.php');

#Set up database abstraction
$pdo = PDOWrapper::instance();
$pdo->configMaster($db[0], $db[1], $db[2], $db[3]); #setup in _secret_keys.php

#If an AJAX request was made to request a key
if (array_key_exists('requestName', $_POST)) {
  #Specifying that the return is JSON
  header('Content-Type: application/json');

  #Making sure all fields are given and well-formed
  if (strpos($_POST['requestName'], '_') == false)
    die(json_encode(['status' => 'failure', 'message' => 'malformed name']));
  if (!array_key_exists('email', $_POST))
    die(json_encode(['status' => 'failure', 'message' => 'email not given']));
  if (!array_key_exists('github', $_POST))
    die(json_encode(['status' => 'failure', 'message' => 'github not given']));
  
  #Making sure a request for this user does not already exist
  $nameSearch = $pdo->select('requests', ['name'=>$_POST['requestName']]);
  if (count($nameSearch) > 0)
    die(json_encode(['status' => 'failure', 'message' => 'already requested']));
  $emailSearch = $pdo->select('requests', ['email'=>$_POST['email']]);
  if (count($emailSearch) > 0)
    die(json_encode(['status' => 'failure', 'message' => 'already requested']));
  $githubSearch = $pdo->select('requests', ['github'=>$_POST['github']]);
  if (count($githubSearch) > 0)
    die(json_encode(['status' => 'failure', 'message' => 'already requested']));

  #Inserting request
  $requestId = $pdo->insert(
    'requests',
    [
      'date' => time(),
      'name' => $_POST['requestName'],
      'email' => $_POST['email'],
      'github' => $_POST['github']
    ]
  );
  die(json_encode(['status' => 'success', 'message' => $requestId]));
}
