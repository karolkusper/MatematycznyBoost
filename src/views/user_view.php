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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500&family=Poppins:wght@400;600&display=swap"
          rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/415b20756c.js" crossorigin="anonymous"></script>
</head>

<body>
<?php include(__DIR__ . "/shared/nav.php"); ?>
<script src="public/js/nav_bar.js"></script>
<div class="container">
    <?php if (isset($user)): ?>
        <h1 id="title">Witaj <?= $user['username'] ?>! Twoje zadania:</h1>
    <?php else: ?>
        <h1 id="title">Moje zadania</h1>
    <?php endif; ?>
    <img src="public/img/toDo.png" alt="obrazek_w_tle" class="backgroundImg"/>
    <div class="content">
        <!-- Dodane sprawdzenie i wyświetlanie message -->
        <?php if (isset($_GET['message'])): ?>
            <div class="message" style="color:#304341;font-size: 1.5rem;">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>
        <?php
        if (isset($homeworks)) {
            foreach ($homeworks as $homework) {
                ?>
                <div class="homework">
                    <div class="homework_title">
                        <h2>Tytuł:</h2><a target="_blank" href=<?= $homework->getPath() ?>>
                            <i class="fa-solid fa-file-arrow-down"></i> <?= $homework->getTitle() ?></a>
                    </div>
                    <?php if (isset($solutions) && isset($solutions[$homework->getHomeworkId()])): ?>
                        <div class="solution">
                            <div class="exercise">
                                <div class="uploaded_file">
                                    <h2>Zamieszczono rozwiązanie:</h2>
                                    <a target="_blank" href=<?= $solutions[$homework->getHomeworkId()]->getSolutionPath() ?>>
                                        <i class="fa-solid fa-file-arrow-down"></i>
                                        <?= $solutions[$homework->getHomeworkId()]->getHomeworkTitle() ?>
                                    </a>
                                </div>
                            </div>
                            <div class="grade">
                                <?php if ($solutions[$homework->getHomeworkId()]->getGrade() !== 0): ?>
                                    <!-- Jeśli ocena już istnieje, wyświetl ikonkę oceny -->
                                    <h2>Ocena:</h2>
                                    <i class="fa-solid fa-<?= $solutions[$homework->getHomeworkId()]->getGrade() ?>"></i>
                                <?php else: ?>
                                    <!-- Jeśli nie ma oceny, pozostaw komunikat "Nie oceniono" -->
                                    <h2>Ocena:</h2>
                                    <h3>Nie oceniono</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <h2>Dodaj swój plik z rozwiązaniem.</h2>
                        <form class="upload" method="POST" action="addExercise" enctype="multipart/form-data">
                            <div class="message" style="color:#304341;font-size: 1.5rem;">
                                <?php
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
                            <select name="homework_select">
                                <option value="" selected>Wybierz zadanie (opcjonalnie)</option>
                                <?php if (isset($uploadedSolutions)) foreach ($uploadedSolutions as $uploadedSolution): ?>
                                    <option value="<?= $uploadedSolution ?>"><?= $uploadedSolution ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Wyślij plik <i class="fa-solid fa-file-arrow-up"></i></button>
                            <h3>Dodaj plik z zadaniem.</h3>
                        </form>

                    <?php endif; ?>
                </div>
            <?php } ?>
        <?php } ?>

    </div>
</div>
</body>

</html>
