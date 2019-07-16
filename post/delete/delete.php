<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    if($_COOKIE['name'] == ''){
        $mysqli->close ();
        header ("Location: /");
        exit;
    }
    else{
    while (($row = $result_set->fetch_assoc()) != false) {
        if($_GET["delete"] == $row["id"]) {
            $id = $row["id"];
            $mysqli->query ("DELETE FROM `posts` WHERE `posts`.`id` =".$id.";");
            $mysqli->close ();
            header ("Location: /");
            exit;
        };
    };
    };
?>