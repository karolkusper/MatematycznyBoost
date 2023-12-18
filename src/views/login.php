<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public/css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500&family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <title>Login page</title>
  </head>
  <body>
    <div class="container">
      <img src="public/img/logo.png" alt="logo" />
      <img src="public/img/login.png" alt="obrazek" class="obrazek_w_tle" />

      <div class="login_box">
        <form class="login" action="login" method="POST">
            <div class="message"
                 style="color:#304341;font-size: 1.5rem;">
                <?
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
          <div class="inputs">
            <input name="email" type="text" placeholder="email" />
            <input name="password" type="password" placeholder="password" />
          </div>
          <button type="submit" class="Log_in">Log in</button>
        </form>

        <div class="h">
          <h3>Don't have an account?</h3>
            <a href="register"><h2>Create an Account</h2></a>
        </div>
      </div>
    </div>
  </body>
</html>
