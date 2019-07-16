<?php
    if($_COOKIE['name'] == ''){
        $mysqli->close ();
        header ("Location: /");
        exit;
    }else{
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");

    $result = $mysqli->query ("SELECT * FROM `posts` ORDER BY posts.id");

    while (($line = $result->fetch_assoc()) != false) {
        $select_like = $mysqli->query ("SELECT * FROM `likes` WHERE `likes`.`post_id` = ".$line["id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");
        $like_result = $select_like->fetch_assoc()["result"];
        if($_GET["like"] == $line["id"]) {
            if($like_result == 1){
                $mysqli->query ("UPDATE `likes` SET `result` = NULL WHERE `likes`.`post_id` = ".$line["id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");
            }else{
                $mysqli->query ("UPDATE `likes` SET `result` = '1' WHERE `likes`.`post_id` = ".$line["id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");     
            }  
        }
    };

    $mysqli->close ();
    header ("Location: /");
    exit;
    };
?>