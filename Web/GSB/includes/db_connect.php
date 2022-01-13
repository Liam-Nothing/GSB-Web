<?php

	// $host = "***REMOVED***" ;
	// $dbusername = "***REMOVED***" ;
	// $dbpassword = "***REMOVED***" ;
	// $dbname = "***REMOVED***";

	$host = "localhost" ;
	$dbusername = "root" ;
	$dbpassword = "" ;
	$dbname = "gsb";

	$pdo = new PDO("mysql:host=".$host, $dbusername, $dbpassword);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);