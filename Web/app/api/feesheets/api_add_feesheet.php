<?php

    //URL & GET PICTURE

    if(!(isset($_SESSION["id"]))){
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }else{
        if(isset($data_from_client)){
            $data = array(["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0], ["is_end", 1, 0]);
            $data = data_security($data);

            if(!$error){

                $sqlr = $database->prepare("
                    INSERT INTO `fee_sheet`
                    (standard_fee, description, use_date, fee, id_user, state) 
                    VALUES (:standard_fee, :description, :use_date, :fee, :id_user, :state)
                ");//url_pict
                $sqlr->bindParam(':standard_fee', $data["standard_fee"]);
                $sqlr->bindParam(':description', $data["description"]);
                $sqlr->bindParam(':use_date', $data["use_date"]);
                $sqlr->bindParam(':fee', $data["fee"]);
                $sqlr->bindParam(':id_user', $_SESSION["id"]);
                if($data["is_end"] == 1){
                    $sqlr->bindValue(':state', 1);
                }else{
                    $sqlr->bindValue(':state', 2);
                }
                // $sqlr->bindParam(':url_pict', $data["url_pict"]);
                if($sqlr->execute()) {
                    $return_data = [
                        "id" => 1,
                        "message" => "Feesheet send"
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
                    "message" => "Error data : ".$error
                ];
            }
        }
    }