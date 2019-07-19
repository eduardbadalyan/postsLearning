<?php
$post_id = filter_var(trim($_POST["post_id"]),FILTER_SANITIZE_STRING);
session_start();
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    
    while (($row = $result_set->fetch_assoc()) != false) {
        if($post_id == $row["id"]) {
            $id = $row["id"];
            $user_id = $row["user_id"];
        };
    };   
    if($_SESSION['user_id'] != $user_id){
        $mysqli->close ();
        echo "fail";
        exit;
    }
    else{
            $mysqli->query ("DELETE FROM `posts` WHERE `posts`.`id` =".$id.";");
            $mysqli->close ();
            echo "success";
            exit;
        };
?>