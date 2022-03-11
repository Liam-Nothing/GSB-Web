<?php

    if(isset($_SESSION["id"])){
        if($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 2 or $_SESSION["id_role"] == 1){ # Ok admin, comptable, admin_region
            if(isset($data_from_client)){
                $data = array(["standard_id", 5, 1]);
                $data = data_security($data);
                if(!$error){
                    $sqlr = $database->prepare("
                        UPDATE `standard_fee`
                        SET deleted = 1
                        WHERE id = :id
                    ");
                    $sqlr->bindParam(':id', $data["standard_id"]);
                    if($sqlr->execute()) {
                        $return_data = [
                            "id" => 1,
                            "message" => "Standard fee removed"
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
                        "message" => "Error post data"
                    ];
                }
            }else{
                $return_data = [
                    "id" => 2,
                    "message" => "Error no post data"
                ];
            }
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