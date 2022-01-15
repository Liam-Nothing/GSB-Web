<?php

    header('Content-Type: application/json');

    require("../includes/func_util.php");

    $database = connectDB("gsb", $config);
    $error = false;

    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

    function post_security($arrays) {
        global $post_json_data;
        global $return_data;
        global $error;

        $array_return = array();
        foreach ($arrays as $array) {
            $variable_name = $array[0];
            $max_leght = $array[1];
            if (isset($post_json_data[$variable_name]) and strlen($post_json_data[$variable_name]) <= $max_leght and strlen($post_json_data[$variable_name]) >= 3 and !empty($post_json_data[$variable_name])) {
                $array_return[$variable_name] = htmlspecialchars($post_json_data[$variable_name]);
            }else{
                $return_data = "{$post_json_data[$variable_name]}\n{$variable_name} doit faire un maximume de {$max_leght} charactères et un minimum de 3 charactères.";
                $error = true;
            }
        }
        return $array_return;
    }

    if(isset($post_json_data)){
        $post_data = array(["username", 50], ["password", 255]);
        $post_data = post_security($post_data);

        if(!$error){
            $sqlr = $database->prepare("SELECT `username`, `password`, `id` FROM users WHERE username = :username");
            $sqlr->bindParam(':username', $post_data["username"]);
            $sqlr->execute();
            $sqlr_rows = $sqlr->fetchAll();
    
            if (!empty($sqlr_rows)) {
                if(password_verify($post_data["password"], $sqlr_rows[0]["password"])){
                    $return_data = "Good password";
                }else{
                    $return_data = "Bad password";
                }
            }else{
                $return_data = "Bad user";
            }
        }
    }

    echo json_encode($return_data);
?>