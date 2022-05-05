<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3) {

		$sqlr = $database->query("
			SELECT disable, zipcode, hire_date, city, adress, birth_date, username, email, last_name, first_name, users.id as user_id, role.label as role_label, role.id as role_id
			FROM users INNER JOIN role
			ON users.id_role = role.id;
		");
		$sqlr_rows = $sqlr->fetchAll();

		if (!empty($sqlr_rows)) {
			$return_data = array();
			// $return_data["content"] = $sqlr_rows;

			$return_data["content"] = array();

			foreach ($sqlr_rows as $row) {
				$newUser = [];
				$newUser["disable"] = $row["disable"];
				$newUser["zipcode"] = $row["zipcode"];
				$newUser["hire_date"] = $row["hire_date"];
				$newUser["city"] = $row["city"];
				$newUser["birth_date"] = $row["birth_date"];
				$newUser["username"] = $row["username"];
				$newUser["email"] = $row["email"];
				$newUser["user_id"] = $row["user_id"];
				$newUser["role_id"] = $row["role_id"];
				$newUser["role_label"] = $row["role_label"];
				$newUser["last_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["last_name"]);
				$newUser["first_name"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["first_name"]);
				$newUser["adress"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["adress"]);
				$newUser["city"] = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '?', $row["city"]);
				array_push($return_data["content"], $newUser);
			}

			$return_data["id"] = 1;
			$return_data["message"] = "Feesheets";

			// var_dump($return_data);
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
