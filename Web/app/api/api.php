<?php

    $return_data = [
        "id" => 0,
        "message" => null
    ];

    $error = false;
	
	require_once("includes/functs_db.php");
	require_once("includes/functs_utils.php");

    header('Content-Type: application/json');
    $data_from_client = (array) json_decode(stripslashes(file_get_contents("php://input")));
    $database = connectDB("***REMOVED***", $config);
    session_start();

    if(count($data_from_client)>0){
		require_once("includes/selector_api.php");
    }elseif (isset($_GET["api"])){
        $data_from_client = $_GET;
        require_once("includes/selector_api.php");
	}else{
		$return_data = [
			"id" => 2,
			"message" => "Empty client data"
		];
	}

    echo json_encode($return_data);