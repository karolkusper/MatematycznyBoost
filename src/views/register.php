<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/css/common_styles.css">
    <link rel="stylesheet" href="/public/css/register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <title>Registration</title>
</head>
<body>
<div class="container">
    <img src="public/img/logo.png" alt="Logo" />
    <img src="public/img/register.png" alt="Obrazek" class="backgroundImg" />

    <div class="register_box">
        <form action="register" method="POST">
            <div class="message" style="color: #304341; font-size: 1.5rem;">
                <?php
                if (isset($messages) && is_array($messages) && !empty($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <div class="inputs">
                <input name="username" type="text" placeholder="Username" />
                <input name="email" type="email" placeholder="Email" />
                <input name="password" type="password" placeholder="Password" />
                <input name="confirmed" type="password" placeholder="Confirm Password" />
            </div>
            <button class="register" type="submit">Register</button>
        </form>

        <div class="h">
            <h3>Already have an account?</h3>
            <a href="index"><h2>Login Now</h2></a>
        </div>
    </div>
</div>
</body>
</html>
