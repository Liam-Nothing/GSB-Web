<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 1) {

		if (isset($data_from_client)) {
			$data = array(["id_feesheet", 5, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					DELETE FROM `fee_sheet`
					WHERE id = :id
				");
				$sqlr->bindParam(':id', $data["id_feesheet"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet deleted";
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
		if (isset($data_from_client)) {
			$data = array(["id_feesheet", 5, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					DELETE FROM `fee_sheet`
					WHERE id = :id
					AND id_user = :id_user
				");
				$sqlr->bindParam(':id', $data["id_feesheet"]);
				$sqlr->bindParam(':id_user', $_SESSION["id"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet deleted";
				} else {
					$return_data["id"] = 2;
					$return_data["message"] = "Error request";
				}
			} else {
				$return_data["id"] = 2;
				$return_data["message"] = "Error!";
			}
		}
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
