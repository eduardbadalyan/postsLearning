<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $select_users = $mysqli->query ("SELECT * FROM `users` ORDER BY id");

    $post_id = $mysqli->query ("SELECT posts.* FROM `posts` ORDER BY posts.id DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC)["id"];
    function addLikes ($post_id,$user_id,$mysqli) {
        $mysqli->query ("INSERT INTO `likes` () VALUES (NULL,'".$post_id."','".$user_id."',NULL)");
    };
    while (($row = $select_users->fetch_assoc()) != false) {
        $user_id = $row["id"];
    addLikes($post_id,$user_id,$mysqli);};
    $mysqli->close ();
    header ("Location: /");
    exit;
?>