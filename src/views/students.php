<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
    <link rel="stylesheet" href="public/css/common_styles.css" />
    <link rel="stylesheet" href="public/css/teacher_view.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500&family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/415b20756c.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="public/css/common_styles.css" />
    <link rel="stylesheet" href="public/css/users.css" />
  </head>
  <body>
    <nav>
      <img src="public/img/logo.png" alt="logo" />
      <ul class="buttons">
        <li><a href="#MojProfil">Mój profil</a></li>
        <li><a href="students">Uczniowie</a></li>
        <li><a href="#Blog">Blog</a></li>
        <li><a href="logout" id="Wyloguj">Wyloguj się</a></li>
      </ul>
      <div class="hamburger">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-x" style="display: none"></i>
      </div>
    </nav>
    <script src="public/js/nav_bar.js"></script>

    <div class="container">
      <img
        src="public/img/classroom.png"
        alt="obrazek_w_tle"
        class="backgroundImg"
      />
        <?php
        $user=$_SESSION['user'];
        if (isset($user)): ?>
            <h1 id="title"><?= $user['username'] ?>: Moi uczniowie</h1>
        <?php else: ?>
            <h1 id="title">Moi uczniowie</h1>
        <?php endif; ?>
      <div class="content">

          <?php
          if(isset($students))
          foreach($students as $student): ?>
          <div class="uczen">
          <img src="/public/uploads/usersPhotos/profile<?= $student->getId() ?>.jpg" alt="zdj profilowe ucznia" />
          <div class="info">
            <div class="dane username">
              <i class="fa-solid fa-user"></i>
              <h2>Username:</h2>
                <h3><?= $student->getUsername() ?></h3>
            </div>
            <div class="dane email">
              <i class="fa-solid fa-envelope"></i>
              <h2>email:</h2>
                <h3><?= $student->getEmail() ?></h3>
            </div>
            <div class="dane zadania">
              <i class="fa-solid fa-list-check"></i>
<!--              <h2>Zadania ucznia</h2>-->
            <a href="teacher_view?student_id=<?= $student->getId() ?>"><h2>Zadania ucznia</h2></a>
            </div>
            <div class="dane usunUcznia">
              <i class="fa-solid fa-user-xmark"></i>
              <h2>Usuń ucznia</h2>
            </div>
          </div>
        </div>
          <?php endforeach; ?>

      </div>
    </div>
  </body>
</html>
