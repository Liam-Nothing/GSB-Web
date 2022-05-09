<?php

if (isset($_SESSION["id"])) {

	$sqlr = $database->prepare("SELECT * FROM `standard_fee`");
	$sqlr->execute();
	$sqlr_rows = $sqlr->fetchAll();

	if (!empty($sqlr_rows)) {
		$return_data = array();
		$return_data["content"] = array();

		foreach ($sqlr_rows as $row) {
			if ($row["deleted"] == 0) {
				$newFeesheet = [];
				$newFeesheet["id"] = $row["id"];
				$newFeesheet["fee"] = $row["fee"];
				$newFeesheet["label"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["label"]);
				array_push($return_data["content"], $newFeesheet);
			}
		}


		$return_data["id"] = 1;
		$return_data["message"] = "Standards fees";
	} else {
		$return_data["id"] = 2;
		$return_data["message"] = "No standards fees found";
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
