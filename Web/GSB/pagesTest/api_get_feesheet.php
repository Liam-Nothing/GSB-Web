<?php

    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");
    $database = connectDB("gsb", $config);

    if(isset($_SESSION["id"])){

        $sqlr = $database->prepare("SELECT * FROM `fee_sheet` WHERE id_user = :id_user");
        $sqlr->bindParam(':id_user', $_SESSION["id"]);
        $sqlr->execute();
        $sqlr_rows = $sqlr->fetchAll();

        if (!empty($sqlr_rows)) {
            $return_data = array();
            foreach($sqlr_rows as $row) {
                $newRow = new stdClass();
                $newRow->id = $row["id"];
                $newRow->description = $row["description"];
                $newRow->fee = $row["fee"];
                $newRow->add_date = $row["add_date"];
                $newRow->use_date = $row["use_date"];
                $newRow->state = $row["state"];
                $newRow->id_user = $row["id_user"];
                $newRow->standard_fee = $row["standard_fee"];
                $newRow->url_pict = $row["url_pict"];
                $return_data[] = $newRow;
                $return_data["id"] = 1;
                $return_data["message"] = "Feesheet";
            }
        }else{
            $return_data = [
                "id" => 2,
                "message" => "No feesheet found"
            ];
        }
    }else{
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }

    echo json_encode($return_data);