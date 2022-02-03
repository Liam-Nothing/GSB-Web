<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");
    
    if(isset($_SESSION["id"])){
        $return_data = [
            "id" => 1,
            "message" => "You are logged on : ".$_SESSION["username"]
        ];
    }else{
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }

    echo json_encode($return_data);
?>