<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User_view</title>
    <link rel="stylesheet" href="public/css/common_styles.css"/>
    <link rel="stylesheet" href="public/css/user_view.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
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
    <img src="public/img/logo.png" alt="logo"/>
    <ul class="buttons">
        <li><a href="#MojProfil">Mój profil</a></li>
        <li><a href="#MojeZadania">Moje zadania</a></li>
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
    <?php if (isset($user)): ?>
        <h1 id="title"><?= $user['username'] ?>: Moje zadania</h1>
    <?php else: ?>
        <h1 id="title">Moje zadania</h1>
    <?php endif; ?>
    <img
            src="public/img/toDo.png"
            alt="obrazek_w_tle"
            class="backgroundImg"
    />
    <div class="content">

        <?php
        if (isset($homeworks))
        foreach ($homeworks as $homework): ?>
        <div class="exercise_not_done">
            <div class="exercise_title">
<!--                <input type="checkbox" class="check"/>-->
                <h2>Tytuł:</h2><a target="_blank" href=<?= $homework->getPath() ?>><?= $homework->getTitle() ?></a>
            </div>
<!--            <div class="upload">-->
<!--                <h2>Moje rozwiązanie:</h2>-->
<!--                <i class="fa-solid fa-file-arrow-up"></i>-->
<!--                <h3>Dodaj swój plik z rozwiązaniem.</h3>-->
<!--            </div>-->
            <h2>Dodaj swój plik z rozwiązaniem.</h2>
            <form class="upload" method="POST" action="addExercise" enctype="multipart/form-data">
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
                <input type="hidden" name="homework_id" value="<?= $homework->getHomeworkId() ?>">
                <input name="title" type="text" placeholder="Tytuł rozwiązania"/>
                <textarea name="description" rows="5" placeholder="Opis rozwiązania"></textarea>
                <input type="file" name="file">
                <button type="submit">Wyślij plik <i class="fa-solid fa-file-arrow-up"></i></button>
                <h3>Dodaj plik z zadaniem.</h3>
            </form>

            <select>
                <option>ZADANIE 1 -</option>
                <option>ZADANIE 1 -</option>
                <option>ZADANIE 1 -</option>
                <option>ZADANIE 1 -</option>
            </select>
        </div>
        <?php endforeach; ?>
        <div class="exercise_done">
            <div class="exercise">
                <div class="exercise_title">
                    <input type="checkbox" class="check"/>
                    <a href="#">Zadanie 2</a>
                </div>
                <div class="uploaded_file">
                    <h2>Zamieszczono rozwiązanie:</h2>
                    <i class="fa-solid fa-file-arrow-down"></i>
                    <a target="_blank" href="/public/uploads/homework/to_wyk1.pdf">to_wyk1.pdf</a>
                </div>
            </div>
            <div class="grade">
                <h2>Ocena:</h2>
                <h3>Nie oceniono</h3>
            </div>
        </div>

    </div>
</body>
</html>
