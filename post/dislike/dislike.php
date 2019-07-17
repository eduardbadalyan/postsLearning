<?php

    $mysqli = new mysqli ("localhost", "root", "root", "myBase");

    $result = $mysqli->query ("SELECT * FROM `posts` ORDER BY posts.id");

        $select_like = $mysqli->query ("SELECT * FROM `likes` WHERE `likes`.`post_id` = ".$_POST["post_id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");
        $like_result = $select_like->fetch_assoc()["result"];

            if(is_null($like_result) == true) {
                $mysqli->query ("INSERT INTO `likes` VALUES (NULL,'".$_POST["post_id"]."','".$_COOKIE["user_id"]."',0);");
                $like = 0;
                $dislike = 1;
                echo $like.",".$dislike;  
            }else{
            if($like_result == 1){
                $mysqli->query ("UPDATE `likes` SET `result` = '0' WHERE `likes`.`post_id` = ".$_POST["post_id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");
                $like = -1;
                $dislike = 1;
                echo $like.",".$dislike;  
            }
            else if($like_result == 0){
                $mysqli->query ("DELETE FROM `likes` WHERE `likes`.`post_id` = ".$_POST["post_id"]." AND `likes`.`user_id` = ".$_COOKIE["user_id"].";");
                $like = 0;
                $dislike = -1;
                echo $like.",".$dislike;
            }
        };
?>