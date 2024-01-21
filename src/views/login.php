<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared_login_register/header.php"); ?>
    <title>Login page</title>
</head>
<body>
<div class="container">
    <img src="public/img/logo.png" alt="logo"/>
    <img src="public/img/login.png" alt="obrazek" class="backgroundImg"/>
    <div class="form-box">
        <form class="login" action="login" method="POST">
            <?php include(__DIR__ . "/shared/message.php"); ?>
            <div class="inputs">
                <input name="email" type="text" placeholder="email"/>
                <input name="password" type="password" placeholder="password"/>
            </div>
            <button type="submit" class="button">Log in</button>
        </form>
        <div class="h">
            <h3>Don't have an account?</h3>
            <a href="register"><h2>Create an Account</h2></a>
        </div>
    </div>
</div>
</body>
</html>
