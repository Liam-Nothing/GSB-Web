<?php

    session_start();

    if(isset($_SESSION["id"])){
        echo "You are logged on : ".$_SESSION["id"];
    }else{
        echo "You are not logged";
    }

?>