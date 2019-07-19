<?php
    $title = filter_var(trim($_POST["title"]),FILTER_SANITIZE_STRING);
    $description = filter_var(trim($_POST["description"]),FILTER_SANITIZE_STRING);
    $id = filter_var(trim($_POST["id"]),FILTER_SANITIZE_NUMBER_INT);

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

        $mysqli = new mysqli ("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");

            $title = addcslashes($title, "'");
            $description = addcslashes($description, "'");

            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["user_id"] = $user_id;
            $mysqli->query ("UPDATE `posts` SET `title` = '".$title."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->query ("UPDATE `posts` SET `description` = '".$description."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->close ();
            echo "success";
            exit();
?>