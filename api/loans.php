<?php
header('Content-Type: application/json');

$myObj = new stdClass();
$myObj->loans = "List of available loans here...";
$myJSON = json_encode($myObj);

echo $myJSON;
