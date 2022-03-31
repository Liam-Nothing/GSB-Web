<?php

    if(isset($_SESSION["id"])){
        if($_SESSION["id_role"] == 3){

            $sqlr = $database->query("SELECT * FROM `fee_sheet`");
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
                }
                $return_data["id"] = 1;
                $return_data["message"] = "Feesheet";
            }else{
                $return_data["id"] = 1;
                $return_data["message"] = "No feesheet found";
            }
        }else{
            $return_data["id"] = 2;
            $return_data["message"] = "You don't have permission to do that : ".$_SESSION["id_role"];
        }
    }else{
        $return_data["id"] = 2;
        $return_data["message"] = "You are not logged";
    }