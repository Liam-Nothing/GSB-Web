<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 1) {

		$sqlr = $database->query("
			SELECT *, state.label as state_label, standard_fee.label as standard_fee_label, role.label as role_label, fee_sheet.id as fee_sheet_id, fee_sheet.fee as fee
			FROM fee_sheet INNER JOIN standard_fee
			ON fee_sheet.standard_fee = standard_fee.id
			INNER JOIN state
			ON fee_sheet.state = state.id
			INNER JOIN users
			ON fee_sheet.id_user = users.id
			INNER JOIN role
			ON users.id_role = role.id;
			");
		$sqlr_rows = $sqlr->fetchAll();

		if (!empty($sqlr_rows)) {
			$return_data = array();
			$return_data["content"] = array();

			foreach ($sqlr_rows as $row) {
				$newFeesheet = [];
				// $newFeesheet["id"] = $row["id"]; // Broken
				$newFeesheet["fee_sheet_id"] = $row["fee_sheet_id"];
				$newFeesheet["description"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["description"]);
				$newFeesheet["fee"] = $row["fee"];
				$newFeesheet["add_date"] = $row["add_date"];
				$newFeesheet["use_date"] = $row["use_date"];
				$newFeesheet["state"] = $row["state"];
				$newFeesheet["id_user"] = $row["id_user"];
				$newFeesheet["username"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["username"]);
				$newFeesheet["email"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["email"]);
				$newFeesheet["first_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["first_name"]);
				$newFeesheet["last_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["last_name"]);
				$newFeesheet["standard_fee"] = $row["standard_fee"];
				$newFeesheet["url_pict"] = $row["url_pict"];
				// Replace unicode char
				$newFeesheet["state_label"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["state_label"]);
				$newFeesheet["standard_fee_label"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["standard_fee_label"]);
				$newFeesheet["role_label"] = $row["role_label"];
				array_push($return_data["content"], $newFeesheet);
			}
			$return_data["id"] = 1;
			$return_data["message"] = "Feesheets";
		} else {
			$return_data["id"] = 1;
			$return_data["message"] = "No feesheet found";
		}
	} elseif ($_SESSION["id_role"] == 2) {
		$return_data["id"] = 1;
		$return_data["message"] = "You are a admin region";
	} else {
		$sqlr = $database->prepare("
		SELECT *, state.label as state_label, standard_fee.label as standard_fee_label, role.label as role_label, fee_sheet.id as fee_sheet_id, fee_sheet.fee as fee
		FROM fee_sheet INNER JOIN standard_fee
		ON fee_sheet.standard_fee = standard_fee.id
		INNER JOIN state
		ON fee_sheet.state = state.id
		INNER JOIN users
		ON fee_sheet.id_user = users.id
		INNER JOIN role
		ON users.id_role = role.id
		WHERE id_user = :id_user;
		");
		$sqlr->bindParam(':id_user', $_SESSION["id"]);
		$sqlr->execute();
		$sqlr_rows = $sqlr->fetchAll();

		if (!empty($sqlr_rows)) {
			$return_data = array();
			$return_data["content"] = array();

			foreach ($sqlr_rows as $row) {
				$newFeesheet = [];
				// $newFeesheet["id"] = $row["id"]; // Broken
				$newFeesheet["fee_sheet_id"] = $row["fee_sheet_id"];
				$newFeesheet["description"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["description"]);
				$newFeesheet["fee"] = $row["fee"];
				$newFeesheet["add_date"] = $row["add_date"];
				$newFeesheet["use_date"] = $row["use_date"];
				$newFeesheet["state"] = $row["state"];
				$newFeesheet["id_user"] = $row["id_user"];
				$newFeesheet["username"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["username"]);
				$newFeesheet["email"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["email"]);
				$newFeesheet["first_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["first_name"]);
				$newFeesheet["last_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["last_name"]);
				$newFeesheet["standard_fee"] = $row["standard_fee"];
				$newFeesheet["url_pict"] = $row["url_pict"];
				// Replace unicode char
				$newFeesheet["state_label"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["state_label"]);
				$newFeesheet["standard_fee_label"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["standard_fee_label"]);
				$newFeesheet["role_label"] = $row["role_label"];
				array_push($return_data["content"], $newFeesheet);
			}
			$return_data["id"] = 1;
			$return_data["message"] = "Feesheet";
		} else {
			$return_data["id"] = 2;
			$return_data["message"] = "No feesheet found";
		}
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
