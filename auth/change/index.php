<?php
    session_start();
    if($_SESSION["user_id"] == "" || $_SESSION["name"] == ""){
        header ("Location: /");
        exit;
    }
    include ('../../config/db.php');
    $result = $mysqli->query("SELECT * FROM `users` WHERE `id`='".$_SESSION["user_id"]."'");
    $user = $result->fetch_assoc();

    $id = $user["id"];
    $name = $user["name"];
    $email = $user["email"];
    $age = $user["age"];
?>
<!DOCTYPE>
<html>
<head>
    <title>change parameters</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/change/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#edit").bind("click",function(e) {
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var age = document.getElementById('age').value;

                e.preventDefault();
                $.ajax ({
                    url: "/auth/change/change.php",
                    type: "POST",
                    data: ({name: name,email: email,age: age}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var nameError = document.getElementById("nameError");
                                var emailError = document.getElementById("emailError");
                                var checkEmailError = document.getElementById("checkEmailError");
                                var ageError = document.getElementById("ageError");

                                var name = document.getElementById('name').value;
                                var email = document.getElementById('email').value;
                                var age = document.getElementById('age').value;

                            if(answer === "fail"){
                                nameError.style.display = "none";
                                emailError.style.display = "none";
                                checkEmailError.style.display = "none";
                                ageError.style.display = "none";
                                
                                if(name === ""){
                                    nameError.style.display = "block";
                                }
                                if(email === ""){
                                    emailError.style.display = "block";
                                }
                                else if(email.includes("@") == false){
                                    checkEmailError.style.display = "block";
                                }
                                if(age === "" || age == 0){
                                    ageError.style.display = "block";
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
    <div class="content">
        <h2>Change user's profile</h2>
        <form name="change" method="post">
            <label for="name"><h4>Name : </h4></label><br>
            <input type="text" id="name" name="name" value="<?=$name?>" placeholder="Name...">
            <span id="nameError" style="color: red;display:none;">Write Name</span><br><br>

            <label for="email"><h4>Email : </h4></label><br>
            <input type="text" id="email" name="email" value="<?=$email?>" placeholder="Email...">
            <span id="emailError" style="color: red;display:none;">Write Email</span>
            <span id="checkEmailError" style="color: red;display:none;">Write Email right</span><br><br>

            <label for="age"><h4>Age : </h4></label><br>
            <input type="number" name="age" id="age" value="<?=$age?>" placeholder="Age...">
            <span id="ageError" style="color: red;display:none;">Write Age</span><br><br>

            <input type="button" id="edit" name="edit" value="Edit" class="btn btn-success">
        </form>
    </div>
</body>
</html>