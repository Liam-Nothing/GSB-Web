<?php

header('Content-Type: application/json');

session_start();

require("../includes/func_util.php");

$database = connectDB("gsb", $config);
$error = false;

if(isset($_SESSION["id"])){
    $return_data = "You are logged on : ".$_SESSION["id"];

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
        }
    }else{
        $return_data = "No feesheet found";
    }
}else{
    $return_data = "You are not logged";
}

echo json_encode($return_data);