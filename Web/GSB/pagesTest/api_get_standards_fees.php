<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");
    $database = connectDB("gsb", $config);
    $post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

    if(isset($_SESSION["id"])){

        $sqlr = $database->prepare("SELECT * FROM `standard_fee`");
        $sqlr->execute();
        $sqlr_rows = $sqlr->fetchAll();

        if (!empty($sqlr_rows)) {
            $return_data = array();
            foreach($sqlr_rows as $row) {  
                if($row["deleted"] == 0 ){
                    $newRow = new stdClass();
                    $newRow->id = $row["id"];
                    $newRow->label = $row["label"];
                    $newRow->fee = $row["fee"];
                    $return_data[] = $newRow;
                }
            }
            $return_data["id"] = 1;
            $return_data["message"] = "Standards fees";
        }else{
            $return_data = [
                "id" => 2,
                "message" => "No standards fees found"
            ];
        }
    }else{
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }

    echo json_encode($return_data);