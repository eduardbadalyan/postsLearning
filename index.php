<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    $result = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    $mysqli->close ();
    
    if(isset($_POST["add_post"])) {
        header ("Location: post/create/");
        exit;
    };
    if(isset($_POST["register"])) {
        header ("Location: auth/register/");
        exit;
    };
    if(isset($_POST["exit"])) {
        header ("Location: auth/exit/exit.php");
        exit;
    };
    while (($line = $result->fetch_assoc()) != false) {
        if(isset($_POST["edit_post".$line["id"].""])) {
            header ("Location: post/edit/?edit=".$line["id"]."");
            exit;
        }
        if(isset($_POST["delete_post".$line["id"].""])) {
            header ("Location: post/delete/delete.php?delete=".$line["id"]."");
            exit;
        }
    };
    if(isset($_POST["home"])) {
        header ("Location: /");
        exit;
    };
    if(isset($_POST["myPosts"])) {
        header ("Location: /?my-posts=1");
        exit;
    };
?>
<html>
    <head>
        <title>test</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <div class="header dropdown-header table-dark">
                <div class="row">
                <?php
                    if($_COOKIE['name'] == ''):
                ?>
                <form name="login" action="auth/login/" method="post">
                <input type="submit" name="login" value="Log in" class="btn btn-outline-light btn-header">
                </form>
                <form action="" name="register" method="post">
                <input type="submit" name="register" value="Register" class="btn btn-outline-light btn-header">
                </form>
                <?php
                    else:
                ?>
                <form action="" name="exit" method="post">
                <span style="color:white;margin-left:20px;">Hello <?=$_COOKIE['name']?>!!!</span>
                <input type="submit" name="exit" value="Exit" class="btn btn-outline-light btn-header"">
                </form>
                <?php
                    endif;
                ?>
                </div>
            </div>
        <div class="content">
        <?php
            if($_COOKIE['name'] != ''):
        ?>
            <form action="" name="pages" method="post" style="position:absolute;right:45%;">
            <input type="submit" name="home" value="Home" class="btn btn-secondary btn-pages">|
            <input type="submit" name="myPosts" value="My Posts" class="btn btn-secondary btn-pages">
            </form><br><br>
        <?php
            endif;
        ?>
            <div class="container-fluid">
                <div class="container">
                    <form action="" name="feed" method="post">
                        <?php
                            if($_COOKIE['name'] != ''):
                        ?>
                        <div class="card text-center card-container">
                            <div class="card-body">
                                <input type="submit" name="add_post" value="Add post" class="btn btn-primary" style="margin:auto;padding:10px;">
                            </div>
                        </div>
                        <?php
                            endif;
                            if($_GET["my-posts"] == 1){
                                function printMyPosts ($result_set) {
                                    while (($row = $result_set->fetch_assoc()) != false) {
                                        if ($_COOKIE['user_id'] == $row["user_id"]){
                                        echo "  <div class=\"card text-justify card-container\">
                                                    <div class=\"card-body\">                                                 
                                                        <h4 class=\"card-title\">".$row["title"]."</h4>
                                                        <p class=\"card-text\">".$row["description"]."</p>
                                                        <p class=\"card-text text-right\" style=\"font-size:12px;\">".$row["name"]."</p>
                                                        <input type=\"submit\" name=\"edit_post".$row["id"]."\" value=\"Edit post\" class=\"btn btn-success\">
                                                        <input type=\"submit\" name=\"delete_post".$row["id"]."\" value=\"Delete post\" class=\"btn btn-danger\">
                                                        </div></div>";
                                                };
                                    }
                                };
                                printMyPosts($result_set);
                            }else{
                            function printResult ($result_set) {
                                while (($row = $result_set->fetch_assoc()) != false) {
                                    echo "  <div class=\"card text-justify card-container\">
                                                <div class=\"card-body\">
                                                    <h4 class=\"card-title\">".$row["title"]."</h4>
                                                    <p class=\"card-text\">".$row["description"]."</p>
                                                    <p class=\"card-text text-right\" style=\"font-size:12px;\">".$row["name"]."</p>";
                                                if($_COOKIE['name'] == ''){
                                                    echo "</div>
                                                    </div>";}
                                                    else if ($_COOKIE['user_id'] == $row["user_id"]){
                                                    echo "<input type=\"submit\" name=\"edit_post".$row["id"]."\" value=\"Edit post\" class=\"btn btn-success\">
                                                    <input type=\"submit\" name=\"delete_post".$row["id"]."\" value=\"Delete post\" class=\"btn btn-danger\">
                                                    </div>
                                            </div>";}
                                            else{
                                                echo "</div></div>";
                                            };
                                }
                            };
                            printResult($result_set);};
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


