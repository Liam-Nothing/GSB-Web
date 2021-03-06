<?php

if (isset($_SESSION["id"])) {

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(
			session_name(),
			'',
			time() - 42000,
			$params["path"],
			$params["domain"],
			$params["secure"],
			$params["httponly"]
		);
	}

	session_destroy();

	$return_data["id"] = 1;
	$return_data["message"] = "Session is destroy";
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "You are not logged";
}
