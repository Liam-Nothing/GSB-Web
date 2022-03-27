<?php

    if(isset($_SESSION["id"])){
        $return_data = [
            "id" => 2,
            "message" => "You are already logged"
        ];
    }else{
        if(isset($data_from_client)){
            $data = array(["username", 50], ["password", 255]);
            $data = data_security($data);

            if(!$error){
                $sqlr = $database->prepare("SELECT `username`, `password`, `id`, `id_role` FROM users WHERE username = :username");
                $sqlr->bindParam(':username', $data["username"]);
                $sqlr->execute();
                $sqlr_rows = $sqlr->fetchAll();
        
                if (!empty($sqlr_rows)) {
                    if(password_verify($data["password"], $sqlr_rows[0]["password"])){
                        $_SESSION["id"] = $sqlr_rows[0]["id"];
                        $_SESSION["username"] = $sqlr_rows[0]["username"];
                        $_SESSION["id_role"] = $sqlr_rows[0]["id_role"];
                        $return_data = [
                            "id" => 1,
                            "message" => "Good password"
                        ];
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
            }else{
                $return_data = [
                    "id" => 2,
                    "message" => "Error!"
                ];
            }
        }
    }