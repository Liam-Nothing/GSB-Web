<?php

if (isset($data_from_client["php_session_id"])) {
	$data = array(["api", 30, 1], ["php_session_id", 100, 1]);
	$data = data_security($data);
	session_id($data["php_session_id"]);
	$return_data["you_set_session_id"] = session_id();
} else {
	$data = array(["api", 30, 1]);
	$data = data_security($data);
}

session_start();
	// $return_data["php_session_id"] = session_id();
	// On set in user_open_session