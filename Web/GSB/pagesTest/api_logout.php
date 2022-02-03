<?php
    
    header('Content-Type: application/json');
    session_start();
    require_once("../includes/func_util.php");

    if(isset($_SESSION["id"])){

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        session_destroy();

        $return_data = [
            "id" => 1,
            "message" => "Session is destroy"
        ];

    }else{
        $return_data = [
            "id" => 2,
            "message" => "You are not logged"
        ];
    }

    echo json_encode($return_data);