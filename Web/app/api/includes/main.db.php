<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../../includes/func_util.php");
    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

    if(!in_array($_SERVER['REMOTE_ADDR'], ["127.0.0.1"])){
        $database = connectDB("***REMOVED***", $config);
    }else{
        $database = connectDB("gsb", $config);
    }

    
    
    