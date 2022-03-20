<?php

    if(isset($_SESSION["id"])){
        if($_SESSION["id_role"] == 3){
            if(isset($data_from_client)){
                $data = array(
                    ["username", 50],
                    ["password", 255],
                    ["email", 255, 0],
                    ["first_name", 50, 0],
                    ["last_name", 50, 0],
                    ["birth_date", 255, 0],
                    ["adress", 100, 0],
                    ["city", 50, 0],
                    ["hire_date", 255, 0],
                    ["id_role", 2, 0],
                    ["zipcode", 10, 0],
                );
                $data = data_security($data);
    
                if(!$error){

                    # if XXX is empty set to NULL in db !

                    $sqlr = $database->prepare("
                        INSERT INTO `users`
                        (username, password, email, first_name, last_name, birth_date, adress, city, hire_date, id_role, zipcode) 
                        VALUES (:username, :password, :email, :first_name, :last_name, :birth_date, :adress, :city, :hire_date, :id_role, :zipcode)
                    ");
                    $sqlr->bindParam(':username', $data["username"]);
                    $sqlr->bindValue(':password', password_hash($data["password"], PASSWORD_DEFAULT));
                    $sqlr->bindParam(':email', $data["email"]);
                    $sqlr->bindParam(':first_name', $data["first_name"]);
                    $sqlr->bindParam(':last_name', $data["last_name"]);
                    $sqlr->bindParam(':birth_date', $data["birth_date"]);
                    $sqlr->bindParam(':adress', $data["adress"]);
                    $sqlr->bindParam(':city', $data["city"]);
                    $sqlr->bindParam(':hire_date', $data["hire_date"]);
                    $sqlr->bindParam(':id_role', $data["id_role"]);
                    $sqlr->bindParam(':zipcode', $data["zipcode"]);

                    if($sqlr->execute()) {
                        $return_data = [
                            "id" => 1,
                            "message" => "User create"
                        ];
                    }else{
                        $return_data = [
                            "id" => 2,
                            "message" => "Error request"
                        ];
                    }

                }else{
                    $return_data = [
                        "id" => 2,
                        "message" => "Error!"
                    ];
                }
            }
        } elseif ($_SESSION["id_role"] == 3) {
            $return_data = [
                "id" => 1,
                "message" => "You are a admin region"
            ];
        }else{
            $return_data = [
                "id" => 2,
                "message" => "You don't have permission to do that : ".$_SESSION["id_role"]
            ];
        }
    }else{
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }