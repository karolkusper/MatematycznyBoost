<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared/header.php"); ?>
    <title>Teacher_view</title>
    <link rel="stylesheet" href="/public/css/shared/user_view__teacher_view.css">
    <link rel="stylesheet" href="/public/css/teacher_view.css"/>
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
        <h1 id="title">Witaj <?= $user['username'] ?>! Oto zadania ucznia: <?= $student->getUsername() ?></h1>
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
                <!-- Dodane sprawdzenie i wyświetlanie message -->
                <?php if (isset($_GET['message'])): ?>
                    <div class="message" style="color:#304341;font-size: 1.5rem;">
                        <?= htmlspecialchars($_GET['message']) ?>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="student_id" value="<?= $student->getId() ?>">
                <!-- Dodaj ukryte pole z id studenta -->
                <input name="title" type="text" placeholder="Tytuł zadania"/>
                <textarea name="description" rows="5" placeholder="Opis zadania"></textarea>
                <input class="custom-file-input" type="file" name="file">
                <select name="homework_select">
                    <option value="" selected>Wybierz zadanie (opcjonalnie)</option>
                    <?php if (isset($uploadedHomeworks)) foreach ($uploadedHomeworks as $uploadedHomework): ?>
                        <option value="<?= $uploadedHomework ?>"><?= $uploadedHomework ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Wyślij plik <i class="fa-solid fa-file-arrow-up"></i></button>
                <h3>Dodaj plik z zadaniem.</h3>
            </form>
        </div>

        <?php
        if (isset($homeworks))
            foreach ($homeworks as $homework): ?>
                <div class="task">
                    <form method="POST" action="gradeSolution">

                        <div class="task_component">
                            <h2>Tytuł:</h2><a target="_blank" href=<?= $homework->getPath() ?>><i
                                        class="fa-solid fa-file-arrow-down"></i> <?= $homework->getTitle() ?></a>
                        </div>
                        <div class="task_component">
                            <h2>Opis:</h2>
                            <p><?= $homework->getDescription() ?></p>
                        </div>
                        <?php if (isset($solutions) && isset($solutions[$homework->getHomeworkId()])): ?>
                            <div class="task_component">
                                <h2>Zamieszczono rozwiązanie:</h2>

                                <a target="_blank"
                                   href=<?= $solutions[$homework->getHomeworkId()]->getSolutionPath() ?>> <i
                                            class="fa-solid fa-file-arrow-down"></i> <?= $solutions[$homework->getHomeworkId()]->getHomeworkTitle() ?>
                                </a>
                            </div>
                            <div class="grade">
                                <?php if ($solutions[$homework->getHomeworkId()]->getGrade() !== 0): ?>
                                    <!-- Jeśli ocena już istnieje, wyświetl ikonkę oceny -->
                                    <h2>Wystawiono ocenę:</h2>
                                    <i class="fa-solid fa-<?= $solutions[$homework->getHomeworkId()]->getGrade() ?>"></i>
                                <?php else: ?>
                                    <!-- Jeśli nie ma oceny, wyświetl formularz -->
                                    <ul class="grades">
                                        <li>
                                            <button type="submit" name="grade" value="1"><i class="fa-solid fa-1"
                                                                                            id="grade-1"></i></button>
                                        </li>
                                        <li>
                                            <button type="submit" name="grade" value="2"><i class="fa-solid fa-2"
                                                                                            id="grade-2"></i></button>
                                        </li>
                                        <li>
                                            <button type="submit" name="grade" value="3"><i class="fa-solid fa-3"
                                                                                            id="grade-3"></i></button>
                                        </li>
                                        <li>
                                            <button type="submit" name="grade" value="4"><i class="fa-solid fa-4"
                                                                                            id="grade-4"></i></button>
                                        </li>
                                        <li>
                                            <button type="submit" name="grade" value="5"><i class="fa-solid fa-5"
                                                                                            id="grade-5"></i></button>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="solution_id"
                                           value="<?= $solutions[$homework->getHomeworkId()]->getSolutionId() ?>">
                                    <input type="hidden" name="student_id" value="<?= $student->getId() ?>">
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="solution_id"
                                   value="<?= $solutions[$homework->getHomeworkId()]->getSolutionId() ?>">
                            <input type="hidden" name="student_id" value="<?= $student->getId() ?>">
                        <?php else: ?>
                            <div class="task_component">
                                <h2>Zamieszczone rozwiązanie:</h2>
                                <p style="color:#cb0202;">Brak rozwiązania!</p>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            <?php endforeach; ?>
    </div>
</div>
</body>
</html>
