<?php
    $title = filter_var(trim($_POST["title"]),FILTER_SANITIZE_STRING);
    $description = filter_var(trim($_POST["description"]),FILTER_SANITIZE_STRING);
    session_start();
    $name = $_SESSION["name"];
    $user_id = $_SESSION["user_id"];
    session_unset();
    session_destroy();

        if($title == "" || $description == ""){
            session_start();
            $_SESSION["title"]=$title;
            $_SESSION["description"]=$description;
            $_SESSION["name"] = $name;
            $_SESSION["user_id"] = $user_id;
            echo "fail";
            exit();
        }

        include ('../../config/db.php');

            $title = addcslashes($title, "'");
            $description = addcslashes($description, "'");

            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["user_id"] = $user_id;
            $mysqli->query ("INSERT INTO `posts` VALUES (NULL,'".$title."','".$description."','".$_SESSION["user_id"]."')");
            $mysqli->close ();
            echo "success";
            exit();
?>