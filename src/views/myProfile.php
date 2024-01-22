<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared/header.php"); ?>
    <title>My profile</title>
    <link rel="stylesheet" href="/public/css/myProfile.css"/>
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
//        $user = $_SESSION['user'];
        if (isset($user)): ?>
            <h1 id="title">Witaj <?= $user['username'] ?>! Oto Twój profil:</h1>
        <?php else: ?>
            <h1 id="title">Mój profil</h1>
        <?php endif; ?>
        <div class="content">
            <?
            $photoPath = "/public/uploads/usersPhotos/profile{$user['id']}.jpg";

            ?>
            <img src="<?= file_exists($_SERVER['DOCUMENT_ROOT'] . $photoPath) ? $photoPath : '/public/uploads/usersPhotos/default.png' ?>"
                 alt="zdj profilowe"/>
            <div class="user_data">
                <h2>Username: <?= $user['username'] ?></h2>
                <h2>Email: <?= $user['email'] ?></h2>
            </div>

        </div>
    </div>
</body>
</html>
