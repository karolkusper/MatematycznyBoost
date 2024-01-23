<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(__DIR__ . "/shared/header.php"); ?>
    <title>My profile</title>
    <link rel="stylesheet" href="/public/css/myProfile.css"/>
    <script type="text/javascript" src="/public/js/alterProfile.js" defer></script>
</head>
<body>
    <?php include(__DIR__ . "/shared/nav.php"); ?>
    <div class="container">
        <img
                src="public/img/myProfile.jpg"
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
            <img class="profile" src="<?= file_exists($_SERVER['DOCUMENT_ROOT'] . $photoPath) ? $photoPath : '/public/uploads/usersPhotos/default.png' ?>"
                 alt="zdj profilowe"/>
            <div class="user_data">
                <h2>Username: <?= $user['username'] ?></h2>
                <h2>Email: <?= $user['email'] ?></h2>
            </div>
        </div>

        <div id="resultContainer"></div>
        <form class="profileForm" id="editProfileForm">
            <label for="editUsername">Nowa nazwa użytkownika:</label>
            <input type="text" id="editUsername" name="editUsername">

            <label for="editEmail">Nowy adres email:</label>
            <input type="email" id="editEmail" name="editEmail">

            <label for="editPassword">Nowe hasło:</label>
            <input type="password" id="editPassword" name="editPassword">

            <button type="button" onclick="alterProfile()">Zapisz zmiany</button>
        </form>
    </div>


</body>
</html>
