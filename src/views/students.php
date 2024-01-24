<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared/header.php"); ?>
    <title>Students</title>
    <link rel="stylesheet" href="public/css/users.css"/>
</head>
<body>
<?php include(__DIR__ . "/shared/nav.php"); ?>
<script src="public/js/nav_bar.js"></script>

<div class="container">
    <img
            src="public/img/classroom.png"
            alt="obrazek_w_tle"
            class="backgroundImg"
    />
    <?php
    $user = $_SESSION['user'];
    if (isset($user)): ?>
        <h1 id="title">Witaj <?= $user['username'] ?>! Oto lista Twoich uczniów</h1>
    <?php else: ?>
        <h1 id="title">Moi uczniowie</h1>
    <?php endif; ?>
    <div class="content">

        <?php
        if (isset($students))
            foreach ($students as $student):
                $photoPath = "/public/uploads/usersPhotos/profile{$student->getId()}.jpg";
                ?>
                <div class="uczen">
                    <img src="<?= file_exists($_SERVER['DOCUMENT_ROOT'] . $photoPath) ? $photoPath : '/public/uploads/usersPhotos/default.png' ?>"
                         alt="zdj profilowe ucznia"/>
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
                            <h2><a href="teacher_view?student_id=<?= $student->getId() ?>">Zadania ucznia</a></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</div>
</body>
</html>
