<?php

#Private endpoint
requireKey();

#Require data to have been posted
requirePost(
  [
    "username" => "string",
    "password" => "string"
  ]
);

#Supported school systems
$supported = [
  'csec'
];

#If specified school system is not supported
if (!in_array($data, $supported))
  throw new Exception('School not supported (' . $data . ')');

#Include school-specific grade-scraping script
require('grades/' . $data . '.php');

#Return the student's grades
$echo = [
  'student' => $student,
  'classes' => $classes,
  'average' => $average,
  'gpa' => $gpa
];
