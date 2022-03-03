<?php

    require_once("../includes/main.db.php");

    if(isset($_SESSION["id"])){
        if($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 2 or $_SESSION["id_role"] == 1){ # Ok admin, comptable, admin_region
            if(isset($post_json_data)){
                $post_data = array(["label", 50, 1], ["fee", 10, 0]);
                $post_data = post_security($post_data);
                if(!$error){
                    $sqlr = $database->prepare("
                        INSERT INTO `standard_fee`
                        (label, fee) 
                        VALUES (:label, :fee)
                    ");
                    $sqlr->bindParam(':label', $post_data["label"]);
                    $sqlr->bindParam(':fee', $post_data["fee"]);
                    if($sqlr->execute()) {
                        $return_data = [
                            "id" => 1,
                            "message" => "Standard fee add"
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

    echo json_encode($return_data);