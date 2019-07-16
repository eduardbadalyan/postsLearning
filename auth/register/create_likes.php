<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $select_posts = $mysqli->query ("SELECT * FROM `posts` ORDER BY id");

    $user_id = $mysqli->query ("SELECT users.* FROM `users` ORDER BY users.id DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC)["id"];
    function addLikes ($post_id,$user_id,$mysqli) {
        $mysqli->query ("INSERT INTO `likes` () VALUES (NULL,'".$post_id."','".$user_id."',NULL)");
    };
    while (($row = $select_posts->fetch_assoc()) != false) {
        $post_id = $row["id"];
    addLikes($post_id,$user_id,$mysqli);};
    $mysqli->close ();
    header ("Location: /");
    exit;
?>