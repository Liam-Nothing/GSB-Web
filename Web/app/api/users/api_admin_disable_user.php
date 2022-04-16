<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3) {
		if (isset($data_from_client)) {
			$data = array(
				["id_user", 3, 1],
				["disable", 2, 1]
			);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					Update `users`
					SET disable = :disable
					WHERE id = :id_user;
				");
				$sqlr->bindParam(':disable', $data["disable"]);
				$sqlr->bindParam(':id_user', $data["id_user"]);

				if ($sqlr->execute()) {
					$return_data["id"] = 1;
					$return_data["message"] = "User updated";
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
