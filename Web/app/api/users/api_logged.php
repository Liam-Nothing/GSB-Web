<?php

    if(isset($_SESSION["id"])){
        $return_data["id"] = 1;
        $return_data["message"] = "You are logged on : ".$_SESSION["username"];
    }else{
        $return_data["id"] = 2;
        $return_data["message"] = "You are not logged";
    }