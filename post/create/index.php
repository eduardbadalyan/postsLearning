<?php
session_start();
    $name = $_SESSION["name"];
    $user_id = $_SESSION["user_id"];
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#done").bind("click",function(e) {
                var title = document.getElementById('title').value;
                var description = document.getElementById('description').value;
                e.preventDefault();
                $.ajax ({
                    url: "/post/create/create.php",
                    type: "POST",
                    data: ({title: title,description: description}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var titleError = document.getElementById("titleError");
                                var descriptionError = document.getElementById("descriptionError");

                                var title = document.getElementById('title').value;
                                var description = document.getElementById('description').value;

                            if(answer === "fail"){
                                titleError.style.display = "none";
                                descriptionError.style.display = "none";

                                if(title === ""){
                                    titleError.style.display = "block";
                                }
                                if(description === ""){
                                    descriptionError.style.display = "block";
                                }
                            }else{
                                var url = "/";
                                $(location).attr('href',url);
                            }
                    }
                });
            });
        });
    </script>
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
        <form name="feed" method="post">
            <label for="title"><h4>Title: </h4></label><br>
            <input type="text" id="title" name="title" style="width:290px;padding:5px;" value="<?=$_SESSION["title"]?>" placeholder="add Title..."><br>
            <span id="titleError" style="color: red;display:none;">Write Title</span><br><br>

            <label for="description"><h4>Description: </h4></label><br>
            <textarea name="description" id="description" cols="30" rows="5" placeholder="Add description..."><?=$_SESSION["description"]?></textarea><br>
            <span id="descriptionError" style="color: red;display:none;">Write Description</span><br><br>

            <h6>User: <?=$_SESSION['name']?></h6><br><br>

            <input type="button" id="done" name="done" value="Done!" class="btn btn-success">
        </form>
    </div>
    <?php
    endif;
    session_unset();
    session_destroy();
    session_start();
        $_SESSION["name"] = $name;
        $_SESSION["user_id"] = $user_id;
    ?>
    
</body>
</html>