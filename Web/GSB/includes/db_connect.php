<?php

	// $host = "nothingefdgsb.mysql.db" ;
	// $dbusername = "nothingefdgsb" ;
	// $dbpassword = "GSBbest2021" ;
	// $dbname = "nothingefdgsb";

	$host = "localhost" ;
	$dbusername = "root" ;
	$dbpassword = "" ;
	$dbname = "gsb";

	$pdo = new PDO("mysql:host=".$host, $dbusername, $dbpassword);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);