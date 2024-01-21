<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared_login_register/header.php");?>
    <title>Registration</title>
</head>
<body>
<div class="container">
    <img src="public/img/logo.png" alt="Logo" />
    <img src="public/img/register.png" alt="Obrazek" class="backgroundImg" />

    <div class="form-box">
        <form action="register" method="POST">
            <?php include(__DIR__ . "/shared/message.php"); ?>
            <div class="inputs">
                <input name="username" type="text" placeholder="Username" />
                <input name="email" type="email" placeholder="Email" />
                <input name="password" type="password" placeholder="Password" />
                <input name="confirmed" type="password" placeholder="Confirm Password" />
            </div>
            <button class="button" type="submit">Register</button>
        </form>

        <div class="h">
            <h3>Already have an account?</h3>
            <a href="index"><h2>Login Now</h2></a>
        </div>
    </div>
</div>
</body>
</html>
