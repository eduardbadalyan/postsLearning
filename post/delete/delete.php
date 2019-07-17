<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    
    while (($row = $result_set->fetch_assoc()) != false) {
        if($_GET["delete"] == $row["id"]) {
            $id = $row["id"];
            $user_id = $row["user_id"];
        };
    };   
    if($_COOKIE['user_id'] != $user_id){
        $mysqli->close ();
        header ("Location: /");
        exit;
    }
    else{
            $mysqli->query ("DELETE FROM `posts` WHERE `posts`.`id` =".$id.";");
            $mysqli->close ();
            header ("Location: /");
            exit;
        };
?>