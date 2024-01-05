<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Teacher_view</title>

    <link rel="stylesheet" href="public/css/common_styles.css"/>
    <link rel="stylesheet" href="public/css/teacher_view.css"/>

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
<?php include(__DIR__ . "/shared/nav.php"); ?>
<div class="container">
    <img
            src="public/img/teacher.png"
            alt="obrazek_w_tle"
            class="backgroundImg"
    />
    <?php
    $user = $_SESSION['user'];
    if (isset($user) && isset($student)): ?>
        <h1 id="title"><?= $user['username'] ?>: Zadania ucznia <?= $student->getUsername() ?></h1>
    <?php else: ?>
        <h1 id="title">Zadania ucznia username</h1>
    <?php endif; ?>
    <div class="content">
        <div class="give_new_task">
            <h2>Zadaj nowe zadania</h2>
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
                <input type="hidden" name="student_id" value="<?= $student->getId() ?>">
                <!-- Dodaj ukryte pole z id studenta -->
                <input name="title" type="text" placeholder="Tytuł zadania"/>
                <textarea name="description" rows="5" placeholder="Opis zadania"></textarea>
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

        <?php
        if (isset($homeworks))
            foreach ($homeworks as $homework): ?>
                <div class="grade_tasks">
                    <div class="task">
                        <div class="task_component">
                           <h2>Tytuł:</h2><a target="_blank" href=<?= $homework->getPath() ?>><?= $homework->getTitle() ?></a>
                        </div>
                        <div class="task_component">
                            <h2>Opis:</h2><?= $homework->getDescription()?>
                        </div>
                        <?php if(isset($solutions)&&isset($solutions[$homework->getHomeworkId()])): ?>
                        <div class="task_component">
                            <h2>Zamieszczono rozwiązanie:</h2>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <a target="_blank" href=<?= $solutions[$homework->getHomeworkId()]->getSolutionPath() ?>><?= $solutions[$homework->getHomeworkId()]->getHomeworkTitle() ?></a>
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
                        <?php else: ?>
                        <div class="task_component">
                            <h2>Zamieszczone rozwiązanie:</h2>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            Brak rozwiązania
                        </div>
                        <?php endif;?>
                    </div>

                </div>
            <?php endforeach; ?>


        <script src="public/js/grades.js"></script>
    </div>
</div>
</body>
</html>
