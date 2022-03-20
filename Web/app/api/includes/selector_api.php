<?php

	$data = array(["api", 30, 1]);
	$data = data_security($data);

    if(!$error){
        switch ($data["api"]) {

            // User management
            case "user_open_session":
                require_once(dirname(__FILE__)."/../users/api_session_open.php");
                break;
            case "user_lougout_session":
                require_once(dirname(__FILE__)."/../users/api_logout.php");
                break;
            case "user_logged_session":
                require_once(dirname(__FILE__)."/../users/api_logged.php");
                break;
            //admin_create_user
            //admin_update_user
            //admin_delete_user

            // Standard feesheets
            case "admin_add_standard_fees":
                require_once(dirname(__FILE__)."/../standard_fees/api_add_standards_fees.php");
                break;
            case "user_get_standard_fees":
                require_once(dirname(__FILE__)."/../standard_fees/api_get_standards_fees.php");
                break;
            case "admin_remove_standard_fees":
                require_once(dirname(__FILE__)."/../standard_fees/api_remove_standards_fees.php");
                break;

            // Feesheets
            case "user_view_all_feesheets":
                require_once(dirname(__FILE__)."/../feesheets/api_get_all_feesheet.php");
                break;
            case "admin_view_all_feesheets":
                require_once(dirname(__FILE__)."/../feesheets/api_admin_get_feesheet.php");
                break;
            case "user_add_feesheets":
                require_once(dirname(__FILE__)."/../feesheets/api_add_feesheet.php");
                break;
            //admin_update_feesheets
            //admin_update_feesheets_state
            //admin_delete_feesheets

            default:
                $return_data = [
                    "id" => 2,
                    "message" => "API doesnt exist"
                ];
        }
    }else{
        $return_data = [
            "id" => 2,
            "message" => "Client data error"
        ];
    }	