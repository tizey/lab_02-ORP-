<!doctype html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Добро пожаловать, для начала работы введите свой логин и пароль</h1><hr>
   <form name = "test" action = "auth.php" method = "post">
        <label>Login: </label>
        <input type = "text" name = "login" class ="log_inpt" placeholder = "Your login"><br><br>
        <label>Password: </label>
        <input type = "password" name = "password" class ="log_inpt" placeholder = "Your password"><br><br><hr>
        <button><font color ="black">Login</font></button>
    </form>
</body>
</html>