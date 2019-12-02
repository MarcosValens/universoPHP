<?php
require_once 'controller/LoginFormController.php';
$loginFormController = new LoginFormController();
$obj = $loginFormController->doGet();
$error = $obj->error;
?>
<html>
<head>
    <title>Login Page</title>
</head>
<body>

<?php if (isset($error) && $error == "true") { ?>
    <h1>ERROR VALIDATION!</h1>
<?php } ?>
<!--action = archivo php-->
<form action="loginForm.php" method="post">

    <label for="userName">Username:</label>
    <br>
    <input type="text" name="user" id="userName">
    <br>
    <label for="password"> Password: </label>
    <br>
    <input type="password" name="password" id="password">
    <br>
    <label for="remember">Remember me?</label>
    <input type="checkbox" name="remember" value="true" id="true">
    <br>
    <input type="submit" value="Login">
</form>
</body>
</html>
