<?php

    header('Content-Type: application/json');

    if (isset($_GET["text"])) {
        $text = "%".$_GET["text"]."%";

        require("includes/db_connect.php");
        $pdo->query("use $dbname");

        $sthandler = $pdo->prepare("SELECT * FROM `text` WHERE data LIKE :data ");
        $sthandler->bindParam(':data',  $text);
        $sthandler->execute();
        $rows = $sthandler->fetchAll();

        $i = 0;

        if (!empty($rows)) {
            foreach($rows as $row) {
                $myObj[$i] = array("id"=>$row["id"], "data"=>$row["data"]);
                $i++;
            }
        }else{
            $myObj = "Not found in database !";
        }

        $myJSON = json_encode($myObj);
        echo $myJSON;
    }
?>