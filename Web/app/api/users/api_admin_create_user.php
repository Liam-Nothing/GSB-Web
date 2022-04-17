<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3) {
		if (isset($data_from_client)) {
			$data = array(
				["username", 50],
				["password", 255],
				["email", 255, 0],
				["first_name", 50, 0],
				["last_name", 50, 0],
				["birth_date", 255, 0],
				["adress", 100, 0],
				["city", 50, 0],
				["hire_date", 255, 0],
				["id_role", 2, 0],
				["zipcode", 10, 0]
			);
			$data = data_security($data);

			if (!$error) {

				# if XXX is empty set to NULL in db !
				$sql_resquest_field_list = ["username", "password", "email", "first_name", "last_name", "birth_date", "adress", "city", "hire_date", "id_role", "zipcode"];
				$sqlr_field = [];
				$sqlr_values = [];
				foreach ($sql_resquest_field_list as $value) {
					if ($data[$value] != "null") {
						array_push($sqlr_field, $value);
						array_push($sqlr_values, ":" . $value);
					}
				}
				unset($value);


				$sqlr = $database->prepare("
						INSERT INTO `users`
						(" . join(", ", $sqlr_field) . ") 
						VALUES (" . join(", ", $sqlr_values) . ")
					");
				foreach ($sqlr_field as $value) {
					if ($value != "username" or $value != "password") {
						$sqlr->bindParam(':' . $value, $data[$value]);
					}
				}
				unset($value);
				$sqlr->bindParam(':username', $data["username"]);
				$sqlr->bindValue(':password', password_hash($data["password"], PASSWORD_DEFAULT));

				if ($sqlr->execute()) {
					$return_data["id"] = 1;
					$return_data["message"] = "User create";
				} else {
					$return_data["id"] = 2;
					$return_data["message"] = "Error request";
				}
			} else {
				$return_data["id"] = 2;
				$return_data["message"] = "Error!";
			}
		}
	} elseif ($_SESSION["id_role"] == 2) {
		$return_data["id"] = 1;
		$return_data["message"] = "You are a admin region";
	} else {
		$return_data["id"] = 2;
		$return_data["message"] = "You don't have permission to do that : " . $_SESSION["id_role"];
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
