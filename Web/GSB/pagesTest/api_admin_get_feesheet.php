<?php

header('Content-Type: application/json');

session_start();

require("../includes/func_util.php");

$database = connectDB("gsb", $config);
$error = false;

$post_json_data = (array) json_decode(stripslashes(file_get_contents("php://input")));

function post_security($arrays) {
    global $post_json_data;
    global $return_data;
    global $error;

    $array_return = array();
    foreach ($arrays as $array) {
        $variable_name = $array[0];
        $max_leght = $array[1];
        if (isset($post_json_data[$variable_name]) and strlen($post_json_data[$variable_name]) <= $max_leght and strlen($post_json_data[$variable_name]) >= 3 and !empty($post_json_data[$variable_name])) {
            $array_return[$variable_name] = htmlspecialchars($post_json_data[$variable_name]);
        }else{
            $return_data = "{$variable_name} doit faire un maximume de {$max_leght} charactères et un minimum de 3 charactères.";
            $error = true;
        }
    }
    return $array_return;
}

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
        }else{
            $return_data = "No feesheet found";
        }
    }else{
        $return_data = "You don't have permission to do that : ".$_SESSION["id_role"];
    }
}else{
    $return_data = "You are not logged";
}

echo json_encode($return_data);