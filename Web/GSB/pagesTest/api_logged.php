<?php

    header('Content-Type: application/json');

    session_start();
    
    if(isset($_SESSION["id"])){
        $return_data = "You are logged on : ".$_SESSION["id"];
    }else{
        $return_data = "You are not logged";
    }

    echo json_encode($return_data);
?>