<?php

if (isset($_SESSION["id"])) {

	$sqlr = $database->prepare("SELECT * FROM `fee_sheet` WHERE id_user = :id_user");
	$sqlr->bindParam(':id_user', $_SESSION["id"]);
	$sqlr->execute();
	$sqlr_rows = $sqlr->fetchAll();

	if (!empty($sqlr_rows)) {
		$return_data = array();
		$return_data["content"] = array();

		foreach ($sqlr_rows as $row) {
			$newFeesheet = [];
			$newFeesheet["id"] = $row["id"];
			$newFeesheet["description"] = $row["description"];
			$newFeesheet["fee"] = $row["fee"];
			$newFeesheet["add_date"] = $row["add_date"];
			$newFeesheet["use_date"] = $row["use_date"];
			$newFeesheet["state"] = $row["state"];
			$newFeesheet["id_user"] = $row["id_user"];
			$newFeesheet["standard_fee"] = $row["standard_fee"];
			$newFeesheet["url_pict"] = $row["url_pict"];
			array_push($return_data["content"], $newFeesheet);
		}
		$return_data["id"] = 1;
		$return_data["message"] = "Feesheet";
	} else {
		$return_data["id"] = 2;
		$return_data["message"] = "No feesheet found";
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
