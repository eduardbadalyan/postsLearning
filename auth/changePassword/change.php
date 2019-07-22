<?php
session_start();
    $oldPassword = filter_var(trim($_POST["oldPassword"]),FILTER_SANITIZE_STRING);
    $newPassword = filter_var(trim($_POST["newPassword"]),FILTER_SANITIZE_STRING);

    $oldPassword = md5($oldPassword);

    $mysqli = new mysqli("localhost", "root", "root", "myBase");
    $result = $mysqli->query("SELECT * FROM `users` WHERE `id`='".$_SESSION[user_id]."'");
    $user = $result->fetch_assoc();

    if($oldPassword != $user["password"] && $newPassword == "") {
        echo "failBoth";
        exit();
    }
    if($oldPassword != $user["password"]) {
        echo "failOldPassword";
        exit();
    }
    if($newPassword == "") {
        echo "failNewPassword";
        exit();
    }

    $newPassword = md5($newPassword);

    $mysqli->query ("UPDATE `users` SET `password` = '".$newPassword."' WHERE `users`.`id` = ".$_SESSION["user_id"].";");

    echo "success";
    exit();
?>