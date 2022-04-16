<?php

$config = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'), true);
if (isset($_GET["debug"]) and $_GET["debug"] === "1") {
	var_dump($_SERVER);
}

if (in_array($_SERVER['REMOTE_ADDR'], [$config["REMOTE_ADDR"]])) {
	$config = [
		"host" => "localhost",
		"dbusername" => "root",
		"dbpassword" => ""
	];
}

function connectDB($dbname, $config)
{
	$pdo = new PDO("mysql:host=" . $config["host"], $config["dbusername"], $config["dbpassword"]);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->query("use $dbname");
	return $pdo;
}
