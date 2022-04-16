<?php

require("../includes/func_util.php");

$old_database = connectDB("old_gsb", $config);
$new_database = connectDB("gsb", $config);

function merge_state()
{
	global $old_database, $new_database;
	$sqlr = $old_database->prepare("SELECT * FROM `etat`");
	$sqlr->execute();
	$rows = $sqlr->fetchAll();

	if (!empty($rows)) {
		echo "\n<br/>" . "ADD DB State" . "\n<br/>";
		$new_database->query("ALTER TABLE `state` AUTO_INCREMENT=0");
		$new_database->query('SET foreign_key_checks = 0');
		foreach ($rows as $row) {

			$sqlr = $new_database->prepare("
					INSERT INTO `state` (`label`)
					VALUES (:state_name)
				");
			$sqlr->bindParam(':state_name',  $row["libelle"]);

			if ($sqlr->execute()) {
				echo "[OK] " . $row["id"] . " " . $row["libelle"] . "\n<br/>";
			} else {
				echo "[Error] " . $row["id"] . " " . $row["libelle"] . "\n<br/>";
			}
		}
		$new_database->query('SET foreign_key_checks = 1');
	} else {
		echo "Empty rows." . "\n<br/>";
	}
}

function merge_standard_fee()
{
	global $old_database, $new_database;
	$sqlr = $old_database->prepare("SELECT * FROM `fraisforfait`");
	$sqlr->execute();
	$rows = $sqlr->fetchAll();

	if (!empty($rows)) {
		echo "\n<br/>" . "ADD DB Standard fee" . "\n<br/>";
		$new_database->query("ALTER TABLE `standard_fee` AUTO_INCREMENT=0");
		$new_database->query('SET foreign_key_checks = 0');
		foreach ($rows as $row) {
			$sqlr = $new_database->prepare("
					INSERT INTO `standard_fee` (`label`, `fee`)
					VALUES (:standard_fee_name, :standard_fee_price)
				");
			$sqlr->bindParam(':standard_fee_name',  $row["libelle"]);
			$sqlr->bindParam(':standard_fee_price',  $row["montant"]);

			if ($sqlr->execute()) {
				echo "[OK] " . $row["id"] . " " . $row["libelle"] . " " . $row["montant"] . "\n<br/>";
			} else {
				echo "[Error] " . $row["id"] . " " . $row["libelle"] . " " . $row["montant"] . "\n<br/>";
			}
		}
		$new_database->query('SET foreign_key_checks = 1');
	} else {
		echo "Empty rows." . "\n<br/>";
	}
}

function merge_users()
{
	global $old_database, $new_database;
	$sqlr = $old_database->prepare("SELECT * FROM `visiteur`");
	$sqlr->execute();
	$rows = $sqlr->fetchAll();

	if (!empty($rows)) {
		echo "\n<br/>" . "ADD DB Users" . "\n<br/>";
		$new_database->query("ALTER TABLE `users` AUTO_INCREMENT=0");
		$new_database->query('SET foreign_key_checks = 0');
		foreach ($rows as $row) {
			$sqlr = $new_database->prepare("
					INSERT INTO `users` (`last_name`, `first_name`, `username`, `password`, `adress`, `zipcode`, `city`, `hire_date`)
					VALUES (:last_name, :first_name, :username, :password, :adress, :zipcode, :city, :hire_date)
				");
			$sqlr->bindParam(':last_name',  $row["nom"]);
			$sqlr->bindParam(':first_name',  $row["prenom"]);
			$sqlr->bindParam(':username',  $row["login"]);
			$sqlr->bindValue(':password',  password_hash($row["mdp"], PASSWORD_DEFAULT));
			$sqlr->bindParam(':adress',  $row["adresse"]);
			$sqlr->bindParam(':zipcode',  $row["cp"]);
			$sqlr->bindParam(':city',  $row["ville"]);
			$sqlr->bindParam(':hire_date',  $row["dateEmbauche"]);

			if ($sqlr->execute()) {
				echo "[OK] " . $row["id"] . " " . $row["nom"] . " " . $row["prenom"] . "\n<br/>";
			} else {
				echo "[Error] " . $row["id"] . " " . $row["nom"] . " " . $row["prenom"] . "\n<br/>";
			}
		}
		$new_database->query('SET foreign_key_checks = 1');
	} else {
		echo "Empty rows." . "\n<br/>";
	}
}

merge_state();
merge_standard_fee();
merge_users();
