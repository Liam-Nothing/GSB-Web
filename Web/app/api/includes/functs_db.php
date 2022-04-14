<?php
    $json_config = json_decode(file_get_contents(dirname(__FILE__).'/config.json'), true);

    if(in_array($_SERVER['REMOTE_ADDR'], [$json_config["localhost"]])){
        $config = [
            "host" => $json_config["host"],
            "dbusername" => $json_config["dbusername"],
            "dbpassword" => $json_config["dbpassword"]
        ];
        if(isset($_GET["debug"]) and $_GET["debug"]==="1"){echo "localhost";}
    }else{
        $config = [
            "host" => $json_config["localhost-host"],
            "dbusername" => $json_config["localhost-username"],
            "dbpassword" => $json_config["localhost-password"]
        ];
        if(isset($_GET["debug"]) and $_GET["debug"]==="1"){echo "online";}
    }

    function connectDB($dbname, $config) {
        $pdo = new PDO("mysql:host=".$config["host"], $config["dbusername"], $config["dbpassword"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("use $dbname");
        return $pdo;
    }