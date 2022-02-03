<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");
    $database = connectDB("gsb", $config);
    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

    if(isset($_SESSION["id"])){
        $return_data = [
            "id" => 2,
            "message" => "You are already logged"
        ];
    }else{
        if(isset($post_json_data)){
            $post_data = array(["username", 50], ["password", 255]);
            $post_data = post_security($post_data);

            if(!$error){
                $sqlr = $database->prepare("SELECT `username`, `password`, `id`, `id_role` FROM users WHERE username = :username");
                $sqlr->bindParam(':username', $post_data["username"]);
                $sqlr->execute();
                $sqlr_rows = $sqlr->fetchAll();
        
                if (!empty($sqlr_rows)) {
                    if(password_verify($post_data["password"], $sqlr_rows[0]["password"])){
                        $return_data = [
                            "id" => 1,
                            "message" => "Good password"
                        ];
                        $_SESSION["id"] = $sqlr_rows[0]["id"];
                        $_SESSION["username"] = $sqlr_rows[0]["username"];
                        $_SESSION["id_role"] = $sqlr_rows[0]["id_role"];
                    }else{
                        $return_data = [
                            "id" => 2,
                            "message" => "Bad password"
                        ];
                    }
                }else{
                    $return_data = [
                        "id" => 2,
                        "message" => "Bad user"
                    ];
                }
            }
        }
    }

    echo json_encode($return_data);