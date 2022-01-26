<?php

    $config = array(
        "host" => "localhost",
        "dbusername" => "root",
        "dbpassword" => ""
    );

    function connectDB($dbname, $config) {
        $pdo = new PDO("mysql:host=".$config["host"], $config["dbusername"], $config["dbpassword"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("use $dbname");

        return $pdo;
    }