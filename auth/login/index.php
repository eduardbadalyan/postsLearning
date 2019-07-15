<!DOCTYPE>
<html>
<head>
    <title>Log In</title>
    <link   rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <h2>Log In</h2>
        <form name="reg" action="auth.php" method="post">

            <label for="email"><h4>Email : </h4></label><br>
            <input type="text" id="email" name="email" placeholder="Email..."><br><br>

            <label for="password"><h4>Password : </h4></label><br>
            <input type="password" id="password" name="password" placeholder="Password..."><br><br>

            <input type="submit" name="create" value="Log in" class="btn btn-success">
        </form>
    </div>
</body>
</html>