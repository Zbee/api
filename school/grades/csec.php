<?php

#Bring in phpQuery
require('/var/www/api/libs/phpQuery.php');

#Load CSEC Infinite Campus portal
$page = file_get_contents(
  'https://cec914.infinitecampus.org/campus/portal/cec.jsp'
);

#Load portal page into phpQuery
phpQuery::newDocument($page);

$form = pq('form');
pq($form)->find('#username')->val($_POST['username']);
pq($form)->find('#password')->val($_POST['password']);
var_dump(pq($form)->submit());

/*
$data = [
  'url' => 'https://cec914.infinitecampus.org/campus/portal/' . $formA,
  'type' => 'POST',
  'data' => json_encode([
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'appName' => 'cec',
    'portalUrl' => 'portal/cec.jsp?&rID=0.4164487063814326',
    'useCSRFProtection' => true,
    'url' => 'portal/main.xsl?rID=0.36278159301400403',
    'lang' => 'en',
    'x' => 53,
    'y' => 11
  ]),
  'dataType' => 'json',
  'contentType' => 'application/json',
  'complete' => function($res, $status) {
    var_dump($status);
    #var_dump($res);
  }
];

phpQuery::ajaxAllowHost('cec914.infinitecampus.org');
@phpQuery::ajax($data);
*/

$student = 'Ethan Henderson';
$classes = ["math" => [0.986, 'a'], "english" => [0.841, 'b']];
$average = [0.922, 'a'];
$gpa = 3.7;
