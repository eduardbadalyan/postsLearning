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
?>
<!DOCTYPE>
<html>
<head>
    <title>change parameters</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/changePassword/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#edit").bind("click",function(e) {
                var oldPassword = document.getElementById('oldPassword').value;
                var newPassword = document.getElementById('newPassword').value;

                e.preventDefault();
                $.ajax ({
                    url: "/auth/changePassword/change.php",
                    type: "POST",
                    data: ({oldPassword: oldPassword,newPassword: newPassword}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var oldPasswordError = document.getElementById("oldPasswordError");
                                var newPasswordError = document.getElementById("newPasswordError");

                            if(answer === "failOldPassword"){
                                oldPasswordError.style.display = "block";
                                newPasswordError.style.display = "none";
                            }else if(answer === "failNewPassword"){
                                oldPasswordError.style.display = "none";
                                newPasswordError.style.display = "block";
                            }else if(answer === "failBoth"){
                                oldPasswordError.style.display = "block";
                                newPasswordError.style.display = "block";
                            }else{
                                var url = "/";
                                $(location).attr('href',url);
                            };
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="content">
        <h2>Change user's profile</h2>
        <form name="change" method="post">
            
            <label for="oldPassword"><h4>Old Password : </h4></label><br>
            <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password...">
            <span id="oldPasswordError" style="color: red;display:none;">Write right password</span><br><br>

            <label for="newPassword"><h4>New Password : </h4></label><br>
            <input type="password" id="newPassword" name="newPassword" placeholder="New Password...">
            <span id="newPasswordError" style="color: red;display:none;">Write password</span><br><br>

            <input type="button" id="edit" name="edit" value="Edit" class="btn btn-success">
            <input type="submit" id="cancel" name="cancel" value="Cancel" class="btn btn-secondary">
        </form>
    </div>
</body>
</html>