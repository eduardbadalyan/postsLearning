<?php
session_start();
        $mysqli = new mysqli ("localhost", "root", "root", "myBase");
        $mysqli->query ("SET NAMES 'utf8'");
        $select_users = $mysqli->query ("SELECT * FROM `users` ORDER BY id");
        if(isset($_POST["done"])) {
            $title = htmlspecialchars ($_POST["title"]);
            $description = htmlspecialchars ($_POST["description"]);
            $user_id = $_SESSION['user_id'];

            $title = addcslashes($title, "'");
            $description = addcslashes($description, "'");

            $mysqli->query ("INSERT INTO `posts` VALUES (NULL,'".$title."','".$description."','".$user_id."')");
            $mysqli->close ();
            header ("Location: /");
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
    <link rel="stylesheet" href="/post/create/style.css">
</head>
<body>
    <?php
    if($_SESSION['name'] == ''):
        $mysqli->close ();
        header ("Location: /");
        exit;
    else:
    ?>
    <div class="content">
        <h2>Add post</h2>
        <form name="feed" action="" method="post">
            <label for="title"><h4>Title: </h4></label><br>
            <input type="text" id="title" name="title" style="width:290px;padding:5px;" placeholder="add Title..."><br><br>

            <label for="description"><h4>Description: </h4></label><br>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Add description..."></textarea><br><br>

            <h6>User: <?=$_SESSION['name'];?></h6><br><br>

            <input type="submit" name="done" value="Done!" class="btn btn-success">
        </form>
    </div>
    <?php
    endif;
    ?>
</body>
</html>