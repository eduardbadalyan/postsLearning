<?php
    session_start();
    include ('config/db.php');
    $result_set = $mysqli->query ("SELECT p.*,`users`.name FROM (SELECT x.*,y.count_dislikes FROM 
                                                                    (SELECT a.*,b.count_likes FROM 
                                                                        (SELECT `posts`.* FROM `posts`) a 
                                                                    LEFT JOIN 
                                                                    (SELECT `posts`.*,COUNT(`likes`.user_id) count_likes FROM `posts` 
                                                                        INNER JOIN `likes` ON `posts`.id=`likes`.post_id WHERE `likes`.result = 1 
                                                                            GROUP BY `likes`.post_id) b 
                                                                    ON a.id=b.id) x
                                                                LEFT JOIN 
                                                                (SELECT `posts`.*,COUNT(`likes`.user_id) count_dislikes FROM `posts` 
                                                                    INNER JOIN `likes` ON `posts`.id=`likes`.post_id 
                                                                        WHERE `likes`.result = 0 
                                                                            GROUP BY `likes`.post_id) y 
                                                                    ON x.id=y.id) p
                                     INNER JOIN `users` ON users.id=p.user_id ORDER BY p.id;");
    $result = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    $result_script = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");

    $select_user = $mysqli->query ("SELECT users.* FROM `users` WHERE `id` = '".$_SESSION["user_id"]."'")->fetch_assoc();

    
    
    if(isset($_POST["add_post"])) {
        header ("Location: /post/create/");
        exit;
    };
    if(isset($_POST["register"])) {
        header ("Location: /auth/register/");
        exit;
    };
    if(isset($_POST["exit"])) {
        header ("Location: /auth/exit/exit.php");
        exit;
    };
    while (($line = $result->fetch_assoc()) != false) {
        if(isset($_POST["edit_post".$line["id"].""])) {
            header ("Location: /post/edit/?edit=".$line["id"]."");
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
        <title>Բամbook</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f5f6b39f2f.js"></script>
        <link rel="stylesheet" href="/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            <?php
                while (($gic = $result_script->fetch_assoc()) != false):
                    $id = $gic["id"];
            ?>
                $(document).ready(function () {
                    $("#like<?=$id?>").bind("click",function(e) {
                        e.preventDefault();
                        $.ajax ({
                            url: "/post/like/like.php",
                            type: "POST",
                            data: ({post_id:<?=$id?>}),
                            dataType: "html",
                            //beforeSend: funcBefore,
                            success: function  (like) {
                                var btndislike = document.getElementById('dislike<?=$id?>');
                                var btnlike = document.getElementById('like<?=$id?>');

                                var cdislike = document.getElementById('cdislike<?=$id?>').innerHTML;
                                var clike = document.getElementById('clike<?=$id?>').innerHTML;

                                var countdislike = parseFloat(cdislike);
                                var countlike = parseFloat(clike);

                                if(like == '1,0'){
                                    btnlike.style.color = "blue";
                                    btndislike.style.color = "grey";
                                    
                                    countlike++;
                                }else if(like == '1,-1'){
                                    btnlike.style.color = "blue";
                                    btndislike.style.color = "grey";

                                    countlike++;
                                    countdislike--;
                                }else if(like == '-1,0'){
                                    btnlike.style.color = "grey";

                                    countlike--;
                                };  
                                
                                document.getElementById('cdislike<?=$id?>').innerHTML = countdislike;
                                document.getElementById('clike<?=$id?>').innerHTML = countlike;
                            }
                        });
                    });
                });
                $(document).ready(function () {
                    $("#dislike<?=$id?>").bind("click",function(e) {
                        e.preventDefault();
                        $.ajax ({
                            url: "/post/dislike/dislike.php",
                            type: "POST",
                            data: ({order:"dislike",post_id:<?=$id?>}),
                            dataType: "html",
                            //beforeSend: funcBefore,
                            success: function (like) {
                                var btndislike = document.getElementById('dislike<?=$id?>');
                                var btnlike = document.getElementById('like<?=$id?>');

                                var cdislike = document.getElementById('cdislike<?=$id?>').innerHTML;
                                var clike = document.getElementById('clike<?=$id?>').innerHTML;

                                var countdislike = parseFloat(cdislike);
                                var countlike = parseFloat(clike);

                                if(like == '0,1'){
                                    btndislike.style.color = "red";
                                    btnlike.style.color = "grey";

                                    countdislike++;
                                }else if(like == '-1,1'){
                                    btndislike.style.color = "red";
                                    btnlike.style.color = "grey";

                                    countdislike++;
                                    countlike--;
                                }else if(like == '0,-1'){
                                    btndislike.style.color = "grey";

                                    countdislike--;
                                }; 
                                
                                document.getElementById('cdislike<?=$id?>').innerHTML = countdislike;
                                document.getElementById('clike<?=$id?>').innerHTML = countlike;
                            }
                        });
                    });
                });
                $(document).ready(function () {
                    $("#delete_post<?=$id?>").bind("click",function(e) {
                        e.preventDefault();
                        $.ajax ({
                            url: "/post/delete/delete.php",
                            type: "POST",
                            data: ({post_id:<?=$id?>}),
                            dataType: "html",
                            //beforeSend: funcBefore,
                            success: function  (answer) {
                                var card = document.getElementById('card<?=$id?>');
                                if(answer === "success"){
                                    card.style.display = "none"
                                };
                            }
                        });
                    });
                });
            <?php
                endwhile;
            ?>
        </script>

    </head>
    <body>
        <div class="header dropdown-header table-dark">
            <div class="row">
                <?php
                    if($_SESSION['name'] == '' && $_SESSION["user_id"] == ""):
                ?>
                <form name="login" action="/auth/login/" method="post">
                    <input type="submit" name="login" value="Log in" class="btn btn-outline-light btn-header">
                </form>
                <form action="" name="register" method="post">
                    <input type="submit" name="register" value="Register" class="btn btn-outline-light btn-header">
                </form>
                <?php
                    else:
                ?>
                    <a href="/auth/changeAvatar/">
                        <div class="avatar-container">
                            <img id="output" alt="Avatar" src="<?=$select_user["avatar"];?>" class="avatar"/>
                            <div class="overlay">
                                <div class="text">Change Avatar</div>
                            </div>
                        </div>
                    </a>
                <form action="" name="exit" method="post">
                    <span style="color:white;margin-left:20px;">Hello <?=$_SESSION['name']?>!!!</span>
                    <input type="submit" name="exit" value="Exit" class="btn btn-outline-light btn-header"">
                </form>
                <form name="changes" action="/auth/change/" method="post">
                    <input type="submit" name="change" value="Edit Profile" class="btn btn-outline-light btn-header">
                </form>
                <form name="changePass" action="/auth/changePassword/" method="post">
                    <input type="submit" name="changePassword" value="Change Password" class="btn btn-outline-light btn-header">
                </form>
                <?php
                    endif;
                ?>
            </div>
        </div>
        <div class="content">
            <?php
                if($_SESSION['name'] != '' && $_SESSION["user_id"] != ""):
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
                            if($_SESSION['name'] != '' && $_SESSION["user_id"] != ""):
                        ?>
                        <div class="card text-center card-container">
                            <div class="card-body">
                                <input type="submit" name="add_post" value="Add post" class="btn btn-primary" style="margin:auto;padding:10px;">
                            </div>
                        </div>
                        <?php
                            endif;
                            if($_GET["my-posts"] == 1){
                                function printMyPosts ($result_set,$mysqli) {
                                    while (($row = $result_set->fetch_assoc()) != false) {
                                        if ($row["count_dislikes"] == NULL) {
                                            $row["count_dislikes"] = 0;
                                        }
                                        if ($row["count_likes"] == NULL) {
                                            $row["count_likes"] = 0;
                                        }
                                        if ($_SESSION['user_id'] == $row["user_id"]){
                                        echo "  <div class=\"card text-justify card-container\" id=\"card".$row["id"]."\">
                                                    <div class=\"card-body\">                                                 
                                                        <h4 class=\"card-title\">".$row["title"]."</h4>
                                                        <p class=\"card-text\">".$row["description"]."</p>
                                                        <p class=\"card-text text-right\" style=\"font-size:12px;\">".$row["name"]."</p>
                                                        <br>";
                                                        $choose_like = $mysqli->query ("SELECT * FROM `likes` WHERE `likes`.`post_id` = ".$row["id"]." AND `likes`.`user_id` = ".$_SESSION["user_id"].";");
                                                        $like_res = $choose_like->fetch_array(MYSQLI_ASSOC)["result"];
                                                        if($_SESSION['name'] != '' && $_SESSION["user_id"] != ""){
                                                        echo "<button id=\"like".$row["id"]."\" name=\"like".$row["id"]."\" style=\"";
                                                        if($like_res != NULL){
                                                        if ($like_res == true){
                                                            echo "color:blue;";
                                                        }}
                                                        echo"\" class=\"btn-like\">
                                                            <i class=\"fas fa-thumbs-up\"></i>
                                                        </button>
                                                        <span style=\"margin-right:20px;";
                                                        echo "\" id=\"clike".$row["id"]."\">".$row["count_likes"]."</span>
                                                        <button id=\"dislike".$row["id"]."\" class=\"btn-dislike\" name=\"dislike".$row["id"]."\" style=\"";
                                                        if($like_res != NULL){
                                                        if ($like_res == false){
                                                            echo "color:red;";
                                                        }}
                                                        echo "\">
                                                            <i class=\"fas fa-thumbs-down\"></i>
                                                            <span style=\"margin-right:20px;";
                                                            $choose_like->free();
                                                        echo "\" id=\"cdislike".$row["id"]."\">".$row["count_dislikes"]."</span>
                                                        </button>
                                                        <br><br>
                                                        <input type=\"submit\" name=\"edit_post".$row["id"]."\" value=\"Edit post\" class=\"btn btn-success\">
                                                        <input type=\"button\" id=\"delete_post".$row["id"]."\" name=\"delete_post".$row["id"]."\" value=\"Delete post\" class=\"btn btn-danger\">
                                                        </div></div>";
                                                };
                                    }
                                };}
                                printMyPosts($result_set,$mysqli);
                            }else{
                            function printResult ($result_set,$mysqli) {
                                while (($row = $result_set->fetch_assoc()) != false) {
                                    if ($row["count_dislikes"] == NULL) {
                                        $row["count_dislikes"] = 0;
                                    }
                                    if ($row["count_likes"] == NULL) {
                                        $row["count_likes"] = 0;
                                    }
                                    echo "  <div class=\"card text-justify card-container\" id=\"card".$row["id"]."\">
                                                <div class=\"card-body\">
                                                    <h4 class=\"card-title\">".$row["title"]."</h4>
                                                    <p class=\"card-text\">".$row["description"]."</p>
                                                    <p class=\"card-text text-right\" style=\"font-size:12px;\">"
                                                    .$row["name"]
                                                    ."</p><br>";
                                                    if($_SESSION["name"] != '' && $_SESSION["user_id"] != ""){
                                                    $choose_like = $mysqli->query ("SELECT * FROM `likes` WHERE `likes`.`post_id` = ".$row["id"]." AND `likes`.`user_id` = ".$_SESSION["user_id"].";");
                                                    $like_res = $choose_like->fetch_array(MYSQLI_ASSOC)["result"];
                                                    echo "<button id=\"like".$row["id"]."\" name=\"like".$row["id"]."\" style=\"";
                                                    if($like_res != NULL){
                                                    if ($like_res == true){
                                                        echo "color:blue;";
                                                    }}
                                                    echo"\" class=\"btn-like\">
                                                        <i class=\"fas fa-thumbs-up\"></i>
                                                        <span style=\"margin-right:20px;";
                                                        echo "\" id=\"clike".$row["id"]."\">".$row["count_likes"]."</span>
                                                    </button>
                                                    <button id=\"dislike".$row["id"]."\" class=\"btn-dislike\" name=\"dislike".$row["id"]."\" style=\"";
                                                    if($like_res != NULL){
                                                    if ($like_res == false){
                                                        echo "color:red;";
                                                    }}
                                                    $choose_like->free();
                                                    echo "\">
                                                        <i class=\"fas fa-thumbs-down\"></i>
                                                        <span style=\"margin-right:20px;";
                                                    echo "\" id=\"cdislike".$row["id"]."\">".$row["count_dislikes"]."</span>
                                                    </button>
                                                    <br><br>";};
                                                if($_SESSION["name"] == '' && $_SESSION["user_id"] == ""){
                                                    echo "</div>
                                                    </div>";}
                                                    else if ($_SESSION['user_id'] == $row["user_id"]){
                                                    echo "<input type=\"submit\" name=\"edit_post".$row["id"]."\" value=\"Edit post\" class=\"btn btn-success\">
                                                    <input type=\"button\" id=\"delete_post".$row["id"]."\" name=\"delete_post".$row["id"]."\" value=\"Delete post\" class=\"btn btn-danger\">
                                                    </div>
                                            </div>";}
                                            else{
                                                echo "</div></div>";
                                            };
                                }
                            };
                            printResult($result_set,$mysqli);};
                            $mysqli->close ();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


