<?php

if (!$error) {

	require_once("functs_repare.php");

	switch ($data["api"]) {

			// User management
		case "all_open_session":
			require_once(dirname(__FILE__) . "/../users/api_session_open.php");
			break;
		case "all_logout_session":
			require_once(dirname(__FILE__) . "/../users/api_logout.php");
			break;
		case "all_logged_session":
			require_once(dirname(__FILE__) . "/../users/api_logged.php");
			break;
		case "admin_create_user":
			require_once(dirname(__FILE__) . "/../users/api_admin_create_user.php");
			break;
		case "admin_update_user":
			require_once(dirname(__FILE__) . "/../users/api_admin_update_user.php");
			break;
		case "admin_disable_user":
			require_once(dirname(__FILE__) . "/../users/api_admin_disable_user.php");
			break;
		case "admin_password_reset_user":
			require_once(dirname(__FILE__) . "/../users/api_admin_password_reset_user.php");
			break;

			// Standard feesheets
		case "all_get_standard_fees":
			require_once(dirname(__FILE__) . "/../standard_fees/api_get_standards_fees.php");
			break;
		case "multi_remove_standard_fees":
			require_once(dirname(__FILE__) . "/../standard_fees/api_remove_standards_fees.php");
			break;
		case "multi_add_standard_fees":
			require_once(dirname(__FILE__) . "/../standard_fees/api_add_standards_fees.php");
			break;

			// Feesheets
		case "user_add_feesheets": //admin_add_feesheets
			require_once(dirname(__FILE__) . "/../feesheets/api_add_feesheet.php");
			break;
		case "multi_update_feesheets":
			require_once(dirname(__FILE__) . "/../feesheets/api_multi_update_feesheets.php");
			break;
		case "multi_view_all_feeesheets":
			require_once(dirname(__FILE__) . "/../feesheets/api_multi_view_all_feeesheets.php");
			break;
		case "multi_delete_feesheets":
			require_once(dirname(__FILE__) . "/../feesheets/api_multi_delete_feesheets.php");
			break;

		default:
			$return_data["id"] = 2;
			$return_data["message"] = "API doesnt exist";
	}
} else {
	$return_data["id"] = 2;
	$return_data["message"] = "Client data error";
}
