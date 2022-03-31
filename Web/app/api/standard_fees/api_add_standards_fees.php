<?php

    if(isset($_SESSION["id"])){
        if($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 2 or $_SESSION["id_role"] == 1){ # Ok admin, comptable, admin_region
            if(isset($data_from_client)){
                $data = array(["label", 50, 1], ["fee", 10, 0]);
                $data = data_security($data);
                if(!$error){
                    $sqlr = $database->prepare("
                        INSERT INTO `standard_fee`
                        (label, fee) 
                        VALUES (:label, :fee)
                    ");
                    $sqlr->bindParam(':label', $data["label"]);
                    $sqlr->bindParam(':fee', $data["fee"]);
                    if($sqlr->execute()) {
                        $return_data["id"] = 1;
                        $return_data["message"] = "Standard fee add";
                    }else{
                        $return_data["id"] = 2;
                        $return_data["message"] = "Error request";
                    }
                }else{
                    $return_data["id"] = 2;
                    $return_data["message"] = "Error post data";
                }
            }else{
                $return_data["id"] = 2;
                $return_data["message"] = "Error no post data";
            }
        }else{
            $return_data["id"] = 2;
            $return_data["message"] = "You don't have permission to do that : ".$_SESSION["id_role"];
        }
    }else{
        $return_data["id"] = 2;
        $return_data["message"] = "You are not logged";
    }