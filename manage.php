<?php
#Specifying that the return is JSON
header('Content-Type: application/json');

#Include passwords and keys
require('_secret_keys.php');

#Include functions
require('libs/functions.php');

#Include database abstraction
require('vendor/mikehenrty/thin-pdo-wrapper/src/PDOWrapper.php');

#Set up database abstraction
$pdo = PDOWrapper::instance();
$pdo->configMaster($db[0], $db[1], $db[2], $db[3]); #setup in _secret_keys.php

#If an AJAX request was made to request a key
if (array_key_exists('requestName', $_POST)) {
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
      'name' => strtolower($_POST['requestName']),
      'email' => strtolower($_POST['email']),
      'github' => strtolower($_POST['github'])
    ]
  );
  die(json_encode(['status' => 'success', 'message' => $requestId]));
}

#If an AJAX request was made to log in
if (array_key_exists('loginEmail', $_POST)) {
  #Checking that the user exists
  $search = $pdo->queryFirst('
    SELECT requests.*, logins.*, `keys`.* FROM requests
    LEFT JOIN logins ON logins.request=requests.id
    LEFT JOIN `keys` ON `keys`.user=requests.id
    WHERE email=:email
  ', [':email'=>strtolower($_POST['loginEmail'])]);
  if (!array_key_exists('id', $search))
    die(json_encode(['status' => 'failure', 'message' => 'no matching email']));

  $password = hash('sha512', $search['salt'] . $_POST['pass']);
  if ($password != $search['password'])
    die(json_encode(['status' => 'failure', 'message' => 'wrong password']));

  $head = '<div class="row"><div class="col-xs-4 col-xs-offset-4 text-center">';
  $body = '<div class="row"><div class="col-xs-8 col-xs-offset-2 text-center">';
  $js = '<script>';

  $permissions = $search['permissions'];

  #If they are not allowed to log in
  if ($permissions[0] == 'a')
    die(json_encode(['status' => 'failure', 'message' => 'account locked']));

  #If they are allowed to access endpoints
  if ($permissions[1] != 'a') {
    $head .= '<a class="btn btn-primary btn-fab" data-toggle="collapse"'
      . ' data-target="#showKey"><i class="material-icons">vpn_key</i></a> ';
    $body .= '<div class="collapse" id="showKey"><br><br><p>This is your API '
      . 'code: <code>' . $search['key'] . '</code></p></div>';
  }

  #If they are an admin of some level
  if ($permissions[2] != 'a') {
    $head .= '<a class="btn btn-primary btn-fab" data-toggle="collapse"'
      . ' data-target="#showReqs"><i class="material-icons">lock_open</i></a> ';
    $body .= '<div class="collapse" id="showReqs"><br><br><p>These are open '
      . 'requests for keys that you may approve.</p><table '
      . 'class="table table-striped table-hover">'
      . '<thead><tr><th>Date</th><th>Name</th><th>GitHub</th><th></th></tr>'
      . '</thead><tbody>';
    foreach ($pdo->select('requests', ['closed'=>'0']) as $row)
      $body .= '<tr><td>' . date("Y-m-d\TH:i", $row['date'])
        . '</td><td>' . ucfirst(explode('_', $row['name'])[0]) . ' '
        . ucfirst(explode('_', $row['name'])[1])
        . '</td><td><a href="https://github.com/' . $row['github'] . '">'
        . ucfirst($row['github']) . '</a></td><td><div class="btn-group-sm">'
        . '<a class="btn btn-default btn-fab">'
          . '<i class="material-icons">thumb_down</i></a> '
        . '<a class="btn btn-default btn-fab">'
          . '<i class="material-icons">thumb_up</i></a>'
        . '</div></td></tr>';
    $body .= '</tbody><table></div>';
  }

  $head .= '</div></div>';
  $body .= '</div></div>';
  $js = '</script>';

  die(json_encode(['status' => 'success', 'message' => $head . $body . $js]));
}
