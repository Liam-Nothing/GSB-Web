<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 2 or $_SESSION["id_role"] == 1) { # Ok admin, comptable, admin_region
		if (isset($data_from_client)) {
			$data = array(["standard_id", 5, 1]);
			$data = data_security($data);
			if (!$error) {
				$sqlr = $database->prepare("
						UPDATE `standard_fee`
						SET deleted = 1
						WHERE id = :id
					");
				$sqlr->bindParam(':id', $data["standard_id"]);
				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Standard fee removed";
				} else {
					$return_data["id"] = 2;
					$return_data["message"] = "Error request";
				}
			} else {
				$return_data["id"] = 2;
				$return_data["message"] = "Error post data";
			}
		} else {
			$return_data["id"] = 2;
			$return_data["message"] = "Error no post data";
		}
	} else {
		$return_data["id"] = 2;
		$return_data["message"] = "You don't have permission to do that : " . $_SESSION["id_role"];
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
