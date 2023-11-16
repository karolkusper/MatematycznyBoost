<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher_view</title>

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
  </head>
  <body>
    <nav>
      <img src="public/img/logo.png" alt="logo" />
      <ul class="buttons">
        <li><a href="#MojProfil">Mój profil</a></li>
        <li><a href="#Uczniowie">Uczniowie</a></li>
        <li><a href="#Blog">Blog</a></li>
        <li><a href="#Wyloguj" id="Wyloguj">Wyloguj się</a></li>
      </ul>
      <div class="hamburger">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-x" style="display: none"></i>
      </div>
    </nav>
    <script src="public/js/nav_bar.js"></script>
    <div class="container">
      <img
        src="public/img/teacher.png"
        alt="obrazek_w_tle"
        class="backgroundImg"
      />
      <h1 id="title">Zadania ucznia username</h1>
      <div class="content">
        <div class="give_new_task">
          <h2>Zadaj nowe zadania</h2>
          <div class="upload">
            <input type="text" placeholder="Tytuł zadania" />
            <i class="fa-solid fa-file-arrow-up"></i>
            <h3>Dodaj plik z zadaniem.</h3>
          </div>
        </div>

        <div class="grade_tasks">
          <div class="task">
            <div class="task_title">
              <input type="checkbox" class="check" />
              <a href="#">Zadanie 1</a>
            </div>
            <div class="uploaded_file">
              <h2>Zamieszczone rozwiązanie:</h2>
              <i class="fa-solid fa-file-arrow-down"></i>
            </div>
          </div>
          <div class="grade">
            <h2>Wystaw ocene:</h2>
            <ul class="grades">
              <li><i class="fa-solid fa-1" id="grade-1"></i></li>
              <li><i class="fa-solid fa-2" id="grade-2"></i></li>
              <li><i class="fa-solid fa-3" id="grade-3"></i></li>
              <li><i class="fa-solid fa-4" id="grade-4"></i></li>
              <li><i class="fa-solid fa-5" id="grade-5"></i></li>
            </ul>
          </div>
        </div>

        <div class="grade_tasks">
          <div class="task">
            <div class="task_title">
              <input type="checkbox" class="check" />
              <a href="#">Zadanie 2</a>
            </div>
            <div class="uploaded_file">
              <h2>Zamieszczone rozwiązanie:</h2>
              <i class="fa-solid fa-file-arrow-down"></i>
            </div>
          </div>
          <div class="grade">
            <h2>Wystaw ocene:</h2>
            <ul class="grades">
              <li><i class="fa-solid fa-1" id="grade-1"></i></li>
              <li><i class="fa-solid fa-2" id="grade-2"></i></li>
              <li><i class="fa-solid fa-3" id="grade-3"></i></li>
              <li><i class="fa-solid fa-4" id="grade-4"></i></li>
              <li><i class="fa-solid fa-5" id="grade-5"></i></li>
            </ul>
          </div>
        </div>

        <div class="grade_tasks">
          <div class="task">
            <div class="task_title">
              <input type="checkbox" class="check" />
              <a href="#">Zadanie 3</a>
            </div>
            <div class="uploaded_file">
              <h2>Zamieszczone rozwiązanie:</h2>
              <i class="fa-solid fa-file-arrow-down"></i>
            </div>
          </div>
          <div class="grade">
            <h2>Wystaw ocene:</h2>
            <ul class="grades">
              <li><i class="fa-solid fa-1" id="grade-1"></i></li>
              <li><i class="fa-solid fa-2" id="grade-2"></i></li>
              <li><i class="fa-solid fa-3" id="grade-3"></i></li>
              <li><i class="fa-solid fa-4" id="grade-4"></i></li>
              <li><i class="fa-solid fa-5" id="grade-5"></i></li>
            </ul>
          </div>
        </div>

        <script src="public/js/grades.js"></script>
      </div>
    </div>
  </body>
</html>
