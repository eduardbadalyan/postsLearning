<?php
        $mysqli = new mysqli ("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");
        $select_users = $mysqli->query ("SELECT * FROM `users` ORDER BY id");
        $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
        while (($row = $result_set->fetch_assoc()) != false) {
            if($_GET["edit"] == $row["id"]) {
                $id =$row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $user_id = $row["user_id"];
            };
        };
        if(isset($_POST["done"])) {
            $title = htmlspecialchars ($_POST["title"]);
            $description = htmlspecialchars ($_POST["description"]);
            $user = htmlspecialchars ($_POST["users"]);
            $user_id = $mysqli->query ("SELECT id FROM `users` WHERE name=\"$user\"")->fetch_assoc()["id"];

            $mysqli->query ("UPDATE `posts` SET `title` = '".$title."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->query ("UPDATE `posts` SET `description` = '".$description."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->query ("UPDATE `posts` SET `user_id` = '".$user_id."' WHERE `posts`.`id` = ".$id.";");
            $mysqli->close ();
            header ("Location: index.php");
            exit;
        };
        $user = $mysqli->query ("SELECT name FROM `users` WHERE id=\"$user_id\"")->fetch_assoc()["name"];
?>
<!DOCTYPE>
<html>
<head>
    <title>Create post</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="style_create.css">
</head>
<body>
    <div class="content">
        <h2>Edit post</h2>
        <form name="feed" action="" method="post">
            <label for="title"><h4>Title: </h4></label><br>
            <input type="text" id="title" name="title" value="<?=$title?>" placeholder="add Title..."><br><br>

            <label for="description"><h4>Description: </h4></label><br>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Add description..."><?=$description?></textarea><br><br>

            <label for=""><h6>Choose user: </h6></label>
            <select name="users" id="users" sele>
                <?php
                    function printResult ($select_users,$user) {
                        while (($row = $select_users->fetch_assoc()) != false) {
                            if($row["name"] == $user){
                                echo "<option value=\"".$row["name"]."\" selected>".$row["name"]."</option>";
                            }
                            else {
                                echo "<option value=\"".$row["name"]."\">".$row["name"]."</option>";
                            }
                        }
                    };
                    printResult($select_users,$user);
                ?>
            </select><br><br>

            <input type="submit" name="done" value="Done!" class="btn btn-success">
        </form>
    </div>
</body>
</html>