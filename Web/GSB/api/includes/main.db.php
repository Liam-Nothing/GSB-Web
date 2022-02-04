<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../../includes/func_util.php");
    $database = connectDB("gsb", $config);
    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));