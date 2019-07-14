<?php
        $mysqli = new mysqli ("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");
        $select_users = $mysqli->query ("SELECT * FROM `users` ORDER BY id");
        if(isset($_POST["done"])) {
            $title = htmlspecialchars ($_POST["title"]);
            $description = htmlspecialchars ($_POST["description"]);
            $user = htmlspecialchars ($_POST["users"]);
            $user_id = $mysqli->query ("SELECT id FROM `users` WHERE name=\"$user\"")->fetch_assoc()["id"];;

            $mysqli->query ("INSERT INTO `posts` VALUES (NULL,'".$title."','".$description."','".$user_id."')");
            $mysqli->close ();
            header ("Location: index.php");
            exit;
        }
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
        <h2>Add post</h2>
        <form name="feed" action="" method="post">
            <label for="title"><h4>Title: </h4></label><br>
            <input type="text" id="title" name="title" placeholder="add Title..."><br><br>

            <label for="description"><h4>Description: </h4></label><br>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Add description..."></textarea><br><br>

            <label for=""><h6>Choose user: </h6></label>
            <select name="users" id="users">
                <?php
                    function printResult ($select_users) {
                        while (($row = $select_users->fetch_assoc()) != false) {
                            echo "<option value=\"".$row["name"]."\">".$row["name"]."</option>";
                        }
                    };
                    printResult($select_users);
                ?>
            </select><br><br>

            <input type="submit" name="done" value="Done!" class="btn btn-success">
        </form>
    </div>
</body>
</html>