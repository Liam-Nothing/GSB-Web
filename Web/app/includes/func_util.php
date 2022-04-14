<?php
    $json_config = json_decode(file_get_contents(dirname(__FILE__).'/config.json'), true);

    if(in_array($_SERVER['REMOTE_ADDR'], [$json_config["localhost"]])){
        $config = [
            "host" => $json_config["host"],
            "dbusername" => $json_config["dbusername"],
            "dbpassword" => $json_config["dbpassword"]
        ];
        if(isset($_GET["debug"]) and $_GET["debug"]==="1"){
			echo "localhost\n<br>";
			var_dump($_SERVER);
		}
    }else{
        $config = [
            "host" => $json_config["localhost-host"],
            "dbusername" => $json_config["localhost-username"],
            "dbpassword" => $json_config["localhost-password"]
        ];
        if(isset($_GET["debug"]) and $_GET["debug"]==="1"){
			echo "online\n<br>";
			var_dump($_SERVER);
		}
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