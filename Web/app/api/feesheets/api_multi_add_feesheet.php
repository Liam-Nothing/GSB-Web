<?php

if (isset($_SESSION["id"])) {
	if ($_SESSION["id_role"] == 3 or $_SESSION["id_role"] == 1) {

		if (isset($data_from_client)) {
			$data = array(["id_user", 10, 0], ["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0], ["state", 1, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					INSERT INTO `fee_sheet`
					(standard_fee, description, use_date, fee, id_user, state) 
					VALUES (:standard_fee, :description, :use_date, :fee, :id_user, :state)
				");
				$sqlr->bindParam(':description', $data["description"]);
				$sqlr->bindParam(':fee', $data["fee"]);
				$sqlr->bindParam(':standard_fee', $data["standard_fee"]);
				$sqlr->bindParam(':use_date', $data["use_date"]);
				$sqlr->bindParam(':state', $data["state"]);
				$sqlr->bindParam(':id_user', $data["id_user"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet create";
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
			$data = array(["description", 150, 0], ["fee", 10, 0], ["standard_fee", 3, 0], ["use_date", 20, 0], ["state", 1, 0]);
			$data = data_security($data);

			if (!$error) {

				$sqlr = $database->prepare("
					INSERT INTO `fee_sheet`
					(standard_fee, description, use_date, fee, id_user, state) 
					VALUES (:standard_fee, :description, :use_date, :fee, :id_user, :state)
				");
				$sqlr->bindParam(':description', $data["description"]);
				$sqlr->bindParam(':fee', $data["fee"]);
				$sqlr->bindParam(':standard_fee', $data["standard_fee"]);
				$sqlr->bindParam(':use_date', $data["use_date"]);
				$sqlr->bindParam(':state', $data["state"]);
				$sqlr->bindParam(':id_user', $_SESSION["id"]);

				if ($sqlr->execute() && $sqlr->rowCount() > 0) {
					$return_data["id"] = 1;
					$return_data["message"] = "Feesheet create";
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
