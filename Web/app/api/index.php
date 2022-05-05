<?php

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
	// We have to check if the origin in $_SERVER['HTTP_ORIGIN'] is an allowed origin.
	// If it is the case, we add the relevant header with lines bellow.
	//if($_SERVER['HTTP_ORIGIN'])=="https://www.gsb.best"
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		// We have here to list all http method allowed for ajax calls.
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}

$return_data = [
	"id" => 0,
	"message" => null
];

$error = false;

require_once("includes/functs_db.php");
require_once("includes/functs_utils.php");

header('Content-Type: application/json');
$data_from_client = (array) json_decode(stripslashes(file_get_contents("php://input")));
$database = connectDB("nothingefdgsb", $config);

if (count($data_from_client) > 0) {
	require_once("includes/selector_api.php");
} elseif (isset($_GET["api"])) {
	$data_from_client = $_GET;
	require_once("includes/selector_api.php");
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "Empty client data";
}

echo json_encode($return_data);
