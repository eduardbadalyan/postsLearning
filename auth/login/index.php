<?php
    session_start();
?>
<!DOCTYPE>
<html>
<head>
    <title>Log In</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="/auth/login/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#login").bind("click",function(e) {
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                e.preventDefault();
                $.ajax ({
                    url: "/auth/login/auth.php",
                    type: "POST",
                    data: ({email: email,password: password}),
                    dataType: "html",
                    //beforeSend: funcBefore,
                    success: function (answer) {
                                var emailError = document.getElementById("emailError");
                                var passwordError = document.getElementById("passwordError");
                            if(answer === "fail"){
                                passwordError.style.display = "block";
                                emailError.style.display = "none";
                            }else if(answer === "failEmail"){
                                passwordError.style.display = "none";
                                emailError.style.display = "block";
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
        <h2>Log In</h2>
        <form name="reg" method="post">

            <label for="email"><h4>Email : </h4></label><br>
            <input type="text" id="email" name="email" value="<?=$_SESSION["email"]?>" placeholder="Email...">
            <span id="emailError" style="color: red;display:none;">Write email right</span><br><br>

            <label for="password"><h4>Password : </h4></label><br>
            <input type="password" id="password" name="password" placeholder="Password...">
            <span id="passwordError" style="color: red;display:none;">Write password right</span><br><br>

            <input type="button" id="login" name="create" value="Log in" class="btn btn-success">
        </form>
    </div>
</body>
<?php
        session_unset();
        session_destroy();
?>
</html>