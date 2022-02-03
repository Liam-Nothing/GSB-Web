<?php

    //URL & GET PICTURE

    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");
    $database = connectDB("gsb", $config);
    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

    if(!(isset($_SESSION["id"]))){
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }else{
        if(isset($post_json_data)){
            $post_data = array(["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0]);
            $post_data = post_security($post_data);

            if(!$error){

                $sqlr = $database->prepare("
                    INSERT INTO `fee_sheet`
                    (standard_fee, description, use_date, fee, id_user) 
                    VALUES (:standard_fee, :description, :use_date, :fee, :id_user)
                ");//url_pict
                $sqlr->bindParam(':standard_fee', $post_data["standard_fee"]);
                $sqlr->bindParam(':description', $post_data["description"]);
                $sqlr->bindParam(':use_date', $post_data["use_date"]);
                $sqlr->bindParam(':fee', $post_data["fee"]);
                $sqlr->bindParam(':id_user', $_SESSION["id"]);
                // $sqlr->bindParam(':url_pict', $post_data["url_pict"]);
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
                    "message" => "Error data"
                ];
            }
        }
    }

    echo json_encode($return_data);