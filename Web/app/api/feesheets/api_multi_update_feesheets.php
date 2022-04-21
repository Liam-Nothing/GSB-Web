<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 1) {

		if (isset($data_from_client)) {
			$data = array(["id_feesheet", 5, 0], ["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0], ["state", 1, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					UPDATE `fee_sheet`
					SET standard_fee = :standard_fee,
					description = :description,
					use_date = :use_date,
					fee = :fee,
					state = :state
					WHERE id = :id
				");
				$sqlr->bindParam(':id', $data["id_feesheet"]);
				$sqlr->bindParam(':description', $data["description"]);
				$sqlr->bindParam(':fee', $data["fee"]);
				$sqlr->bindParam(':standard_fee', $data["standard_fee"]);
				$sqlr->bindParam(':use_date', $data["use_date"]);
				$sqlr->bindParam(':state', $data["state"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet updated";
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
			$data = array(["id_feesheet", 5, 0], ["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0], ["state", 1, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					UPDATE `fee_sheet`
					SET standard_fee = :standard_fee,
					description = :description,
					use_date = :use_date,
					fee = :fee,
					state = :state
					WHERE id = :id
					AND id_user = :id_user
				");
				$sqlr->bindParam(':id', $data["id_feesheet"]);
				$sqlr->bindParam(':description', $data["description"]);
				$sqlr->bindParam(':fee', $data["fee"]);
				$sqlr->bindParam(':standard_fee', $data["standard_fee"]);
				$sqlr->bindParam(':use_date', $data["use_date"]);
				$sqlr->bindParam(':state', $data["state"]);
				$sqlr->bindParam(':id_user', $_SESSION["id"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet updated";
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
