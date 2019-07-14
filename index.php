<?php
    $mysqli = new mysqli ("localhost", "root", "root", "myBase");
    $mysqli->query ("SET NAMES 'utf8'");
    $result_set = $mysqli->query ("SELECT posts.*,users.name FROM `posts` INNER JOIN `users` ON users.id=posts.user_id ORDER BY posts.id");
    $mysqli->close ();

    
    if(isset($_POST["add_post"])) {
        header ("Location: create.php?create=1");
        exit;
    };

    $count = $result_set->num_rows;
    for($i=1 ; $i<= $count ; $i++) {
        if(isset($_POST["edit_post".$i.""])) {
            header ("Location: edit.php?edit=".$i."");
            exit;
        }
        if(isset($_POST["delete_post".$i.""])) {
            header ("Location: delete.php?delete=".$i."");
            exit;
        }
    };
?>
<html>
    <head>
        <title>test</title>
        <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                                 integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                                 crossorigin="anonymous">
        <link rel="stylesheet" href="style_index.css">
    </head>
    <body>
        <div class="header dropdown-header table-dark">
            <span class="btn title-header">Start Bootstrap</span>
            <span class="btn btn-dark btn-header">Contact</span>
            <span class="btn btn-dark btn-header">Services</span>
            <span class="btn btn-dark btn-header">About</span>
            <span class="btn btn-dark btn-header">Home</span>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="container">
                    <form action="" name="feed" method="post">
                        <?php
                            function printResult ($result_set) {
                                while (($row = $result_set->fetch_assoc()) != false) {
                                    echo "  <div class=\"card text-justify card-container\">
                                                <div class=\"card-body\">
                                                    <h4 class=\"card-title\">".$row["title"]."</h4>
                                                    <p class=\"card-text\">".$row["description"]."</p>
                                                    <p class=\"card-text text-right\" style=\"font-size:12px;\">".$row["name"]."</p>
                                                    <input type=\"submit\" name=\"edit_post".$row["id"]."\" value=\"Edit post\" class=\"btn btn-success\">
                                                    <input type=\"submit\" name=\"delete_post".$row["id"]."\" value=\"Delete post\" class=\"btn btn-danger\">
                                                </div>
                                            </div>";
                                }
                            };
                            printResult($result_set);
                        ?>
                        <div class="card text-center card-container">
                            <div class="card-body">
                                <input type="submit" name="add_post" value="Add post" class="btn btn-primary" style="margin:auto;padding:10px;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


