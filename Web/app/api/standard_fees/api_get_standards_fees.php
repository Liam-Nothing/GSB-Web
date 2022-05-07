<?php

if (isset($_SESSION["id"])) {

	$sqlr = $database->prepare("SELECT * FROM `standard_fee`");
	$sqlr->execute();
	$sqlr_rows = $sqlr->fetchAll();

	if (!empty($sqlr_rows)) {
		$return_data = array();
		foreach ($sqlr_rows as $row) {
			if ($row["deleted"] == 0) {
				$newRow = new stdClass();
				$newRow->id = $row["id"];
				$newRow->label = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["label"]);
				$newRow->fee = $row["fee"];
				$return_data[] = $newRow;
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
