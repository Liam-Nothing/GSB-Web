<?php

    require("../includes/func_util.php");

    $database = connectDB("gsb", $config);

    function post_security($arrays) {
        global $message;

        $array_return = array();
        foreach ($arrays as $array) {
            $variable_name = $array[0];
            $max_leght = $array[1];
            if (isset($_POST[$variable_name]) and strlen($_POST[$variable_name]) <= $max_leght and strlen($_POST[$variable_name]) >= 3 and !empty($_POST[$variable_name])) {
                $array_return[$variable_name] = htmlspecialchars($_POST[$variable_name]);
            }else{
                echo "{$variable_name} doit faire un maximume de {$max_leght} charactères et un minimum de 3 charactères.";
                exit();
            }
        }
        return $array_return;
    }

    if(isset($_POST["username"])){
        $post_data = array(["username", 50], ["password", 255]);
        $post_data = post_security($post_data);

        $sqlr = $database->prepare("SELECT `username`, `password`, `id` FROM users WHERE username = :username");
        $sqlr->bindParam(':username', $post_data["username"]);
        $sqlr->execute();
        $sqlr_rows = $sqlr->fetchAll();

        if (!empty($sqlr_rows)) {
            if(password_verify($post_data["password"], $sqlr_rows[0]["password"])){
                $return_text = "Good password";
            }else{
                $return_text = "Bad password";
            }
        }else{
            $return_text = "Bad user";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Password POST Direct connect DB</h1>
    <p>You can try : lvillachane | jux7g</p>
    <form action="" method="post">
        <input type="text" name="username" id="">
        <input type="text" name="password" id="">
        <input type="submit" value="Se connecter">
    </form>
    <strong><?php echo (isset($return_text)) ? $return_text : '_'; ?></strong>
</body>
</html>