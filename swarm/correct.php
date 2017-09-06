<?php

#Private endpoint
requireKey();

#Require data to have been posted
requirePost(
  [
    "venueID" => "string",
  ]
);