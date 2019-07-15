<?php
    
    if($_GET["error"] == 1) {
        $name = htmlspecialchars ($_POST["name"]);
        $email = htmlspecialchars ($_POST["email"]);
        $password = htmlspecialchars ($_POST["password"]);
        $checkPassword = htmlspecialchars ($_POST["checkPassword"]);
        $age = htmlspecialchars ($_POST["age"]);

        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["checkPassword"] = $checkPassword;
        $_SESSION["age"] = $age;

        $error_name = "";
        $error_email = "";
        $error_password = "";
        $error_checkPassword = "";
        $error_age = "";

        if(strlen($name) == 0) {
            $error_name = "Wrire Name";
            $error = true;
        }

        if($email == "" || !preg_match ("/@/", $email)) {
            $error_email = "Wrire right Mail";
            $error = true;
        }

        if(strlen($password) == 0) {
            $error_password = "Wrire Password right";
            $error = true;
        }

        if($password != $checkPassword){
            $error_checkPassword = "Wrire Password right";
            $error = true;
        }

        if($age == 0 || $age == "") {
            $error_age = "Wrire Age";
            $error = true;
        } 

        
    };
?>
<!DOCTYPE>
<html>
<head>
    <title>Registration</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="style_reg.css">
</head>
<body>
    <div class="content">
        <h2>Create new user</h2>
        <form name="reg" action="check.php" method="post">
            <label for="name"><h4>Name : </h4></label><br>
            <input type="text" id="name" name="name" placeholder="Name...">
            <span style="color: red;"><?=$error_name?></span><br><br>

            <label for="email"><h4>Email : </h4></label><br>
            <input type="text" id="email" name="email" placeholder="Email...">
            <span style="color: red;"><?=$error_email?></span><br><br>

            <label for="password"><h4>Password : </h4></label><br>
            <input type="password" id="password" name="password" placeholder="Password...">
            <span style="color: red;"><?=$error_password?></span><br><br>

            <label for="checkPassword"><h4>Password : </h4></label><br>
            <input type="password" id="checkPassword" name="checkPassword" placeholder="Reply password...">
            <span style="color: red;"><?=$error_checkPassword?></span><br><br>

            <label for="age"><h4>Age : </h4></label><br>
            <input type="number" name="age" id="age" placeholder="Age...">
            <span style="color: red;"><?=$error_age?></span><br><br>

            <input type="submit" name="create" value="Create" class="btn btn-success">
        </form>
    </div>
</body>
</html>