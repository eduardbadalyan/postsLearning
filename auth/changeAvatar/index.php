 <?php
    session_start();
    if($_SESSION["user_id"] == "" || $_SESSION["name"] == ""){
        header ("Location: /");
        exit;
    }
    include ('../../config/db.php');
    $result = $mysqli->query("SELECT * FROM `users` WHERE `id`='".$_SESSION["user_id"]."'");
    $user = $result->fetch_assoc();

    if(isset($_POST["cancel"])) {
        header ("Location: /");
        exit;
    };
    if(isset($_POST["edit"])) {
        $error = array();
        $file_name = $_FILES["image"]["name"];
        $file_type = $_FILES["image"]["type"];
        $file_size = $_FILES["image"]["size"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_ext = strtolower(end(explode('.', $_FILES["image"]["name"])));
        $extensions = array('jpeg','jpg','png');
        if (in_array($file_ext,$extensions) == false) {
            $error[] = "Please choose the image of other format";
        }
        if (empty($error) == true) {
            $img = file_get_contents($file_tmp);
            $data = base64_encode($img);
            $data = "data:image/gif;base64,".$data;
            $mysqli->query ("UPDATE `users` SET `avatar` = '".$data."' WHERE `users`.`id` = ".$_SESSION["user_id"].";");
            $mysqli->close ();
            header ("Location: /");
            exit;
        }
    };
?>
<!DOCTYPE>
<html>
<head>
    <title>change parameters</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/changeAvatar/styles.css">
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</head>
<body>
    <div class="content">
        <h2>Change your Avatar</h2>
        <form name="change" method="POST" enctype="multipart/form-data" action="/auth/changeAvatar/"><br>

            <label for="newAvatar"><h4>Choose New Avatar : </h4></label>
            <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" multiple onchange="loadFile(event)"><br><br>

            <img id="output" src="<?=$user["avatar"];?>" class="image"/><br><br>

            <input type="submit" id="edit" name="edit" value="Edit" class="btn btn-success">
            <input type="submit" id="cancel" name="cancel" value="Cancel" class="btn btn-secondary"">
        </form>
    </div>
</body>
</html>
