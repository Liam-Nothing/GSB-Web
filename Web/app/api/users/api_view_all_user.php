<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3) {

		$sqlr = $database->query("
			SELECT disable, zipcode, hire_date, city, adress, birth_date, username, email, last_name, first_name, users.id as user_id, role.label as role_label
			FROM users INNER JOIN role
			ON users.id_role = role.id;
		");
		$sqlr_rows = $sqlr->fetchAll();

		if (!empty($sqlr_rows)) {
			$return_data = array();
			$return_data["content"] = $sqlr_rows;
			$return_data["id"] = 1;
			$return_data["message"] = "Feesheets";
		} else {
			$return_data["id"] = 1;
			$return_data["message"] = "No feesheet found";
		}
	} else {
		$return_data["id"] = 1;
		$return_data["message"] = "You don't have permission to do this.";
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
