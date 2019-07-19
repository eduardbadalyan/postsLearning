<?php
    session_start();
?>
<!DOCTYPE>
<html>
<head>
    <title>Registration</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/register/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#create").bind("click",function(e) {
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var age = document.getElementById('age').value;

                e.preventDefault();
                $.ajax ({
                    url: "/auth/register/check.php",
                    type: "POST",
                    data: ({name: name,email: email,password: password,age: age}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var nameError = document.getElementById("nameError");
                                var emailError = document.getElementById("emailError");
                                var checkEmailError = document.getElementById("checkEmailError");
                                var passwordError = document.getElementById("passwordError");
                                var ageError = document.getElementById("ageError");

                                var name = document.getElementById('name').value;
                                var email = document.getElementById('email').value;
                                var password = document.getElementById('password').value;
                                var age = document.getElementById('age').value;

                            if(answer === "fail"){
                                nameError.style.display = "none";
                                emailError.style.display = "none";
                                checkEmailError.style.display = "none";
                                passwordError.style.display = "none";
                                ageError.style.display = "none";

                                var count = 0;

                                if(name === ""){
                                    nameError.style.display = "block";
                                    count++;
                                }
                                if(email === ""){
                                    emailError.style.display = "block";
                                    count++;
                                }
                                else if(email.includes("@") == false){
                                    checkEmailError.style.display = "block";
                                    count++;
                                }
                                if(age === "" || age == 0){
                                    ageError.style.display = "block";
                                    count++;
                                }
                                if(count == 0){
                                    passwordError.style.display = "block";
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
        <h2>Create new user</h2>
        <form name="reg" method="post">
            <label for="name"><h4>Name : </h4></label><br>
            <input type="text" id="name" name="name" value="<?=$_SESSION["name"]?>" placeholder="Name...">
            <span id="nameError" style="color: red;display:none;">Write Name</span><br><br>

            <label for="email"><h4>Email : </h4></label><br>
            <input type="text" id="email" name="email" value="<?=$_SESSION["email"]?>" placeholder="Email...">
            <span id="emailError" style="color: red;display:none;">Write Email</span>
            <span id="checkEmailError" style="color: red;display:none;">Write Email right</span><br><br>

            <label for="password"><h4>Password : </h4></label><br>
            <input type="password" id="password" name="password" placeholder="Password...">
            <span id="passwordError" style="color: red;display:none;">Write password</span><br><br>

            <label for="age"><h4>Age : </h4></label><br>
            <input type="number" name="age" id="age" value="<?=$_SESSION["age"]?>" placeholder="Age...">
            <span id="ageError" style="color: red;display:none;">Write Age</span><br><br>

            <input type="button" id="create" name="create" value="Create" class="btn btn-success">
        </form>
    </div>
    <?php
        session_unset();
        session_destroy();
    ?>
</body>
</html>