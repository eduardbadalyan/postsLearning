<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");

    while (($row = $result_set->fetch_assoc()) != false) {
        if($_GET["delete"] == $row["id"]) {
            $id = $row["id"];
            $mysqli->query ("DELETE FROM `posts` WHERE `posts`.`id` =".$id.";");
            $mysqli->query ("ALTER TABLE `posts` DROP `id`;");
            $mysqli->query ("ALTER TABLE `posts` ADD `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);");
            $mysqli->close ();
            header ("Location: index.php");
            exit;
        };
    };
?>