<?php

    $config = [
        "host" => ***REMOVED***,
        "dbusername" => ***REMOVED***,
        "dbpassword" => ***REMOVED***
    ];

    if(in_array($_SERVER['REMOTE_ADDR'], ["127.0.0.1"])){
        $config = [
            "host" => "localhost",
            "dbusername" => "root",
            "dbpassword" => ""
        ];
    }

    $return_data = [
        "id" => 0,
        "message" => null
    ];

    $error = false;

    function connectDB($dbname, $config) {
        $pdo = new PDO("mysql:host=".$config["host"], $config["dbusername"], $config["dbpassword"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("use $dbname");

        return $pdo;
    }

    function post_security($arrays) {
        global $post_json_data;
        global $error;

        $array_return = array();
        foreach ($arrays as $array) {
            $variable_name = $array[0];
            $max_leght = $array[1];
            if(isset($array[2])){
                $min_leght = $array[2];
            }else{
                $min_leght = 3;
            }
            if (isset($post_json_data[$variable_name]) and strlen($post_json_data[$variable_name]) <= $max_leght and strlen($post_json_data[$variable_name]) >= $min_leght and !empty($post_json_data[$variable_name])) {
                $array_return[$variable_name] = htmlspecialchars($post_json_data[$variable_name]);
            }else{
                $error = true;
            }
        }
        return $array_return;
    }