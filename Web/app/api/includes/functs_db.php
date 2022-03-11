<?php
    $config = json_decode(file_get_contents(dirname(__FILE__)."\\config.json"), true);

    if(in_array($_SERVER['REMOTE_ADDR'], ["127.0.0.1"])){
        $config = [
            "host" => "localhost",
            "dbusername" => "root",
            "dbpassword" => ""
        ];
    }

    function connectDB($dbname, $config) {
        $pdo = new PDO("mysql:host=".$config["host"], $config["dbusername"], $config["dbpassword"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("use $dbname");
        return $pdo;
    }