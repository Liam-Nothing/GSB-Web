<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3) {

		$sqlr = $database->query("
			SELECT *, state.label as state_label, standard_fee.label as standard_fee_label, role.label as role_label
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
				$newFeesheet["id"] = $row["id"];
				$newFeesheet["description"] = $row["description"];
				$newFeesheet["fee"] = $row["fee"];
				$newFeesheet["add_date"] = $row["add_date"];
				$newFeesheet["use_date"] = $row["use_date"];
				$newFeesheet["state"] = $row["state"];
				$newFeesheet["id_user"] = $row["id_user"];
				$newFeesheet["username"] = $row["username"];
				$newFeesheet["email"] = $row["email"];
				$newFeesheet["first_name"] = $row["first_name"];
				$newFeesheet["last_name"] = $row["last_name"];
				$newFeesheet["standard_fee"] = $row["standard_fee"];
				$newFeesheet["url_pict"] = $row["url_pict"];
				$newFeesheet["state_label"] = $row["state_label"];
				$newFeesheet["standard_fee_label"] = $row["standard_fee_label"];
				$newFeesheet["role_label"] = $row["role_label"];
				// $newFeesheet["fullrow"] = $row;
				array_push($return_data["content"], $newFeesheet);
			}
			$return_data["id"] = 1;
			$return_data["message"] = "Feesheets";
		} else {
			$return_data["id"] = 1;
			$return_data["message"] = "No feesheet found";
		}
	} else {
		$return_data["id"] = 2;
		$return_data["message"] = "You don't have permission to do that : " . $_SESSION["id_role"];
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
