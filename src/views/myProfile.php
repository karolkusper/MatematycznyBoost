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
    if (isset($user)): ?>
        <div id="Title"><h1 id="title">Witaj <?= $user['username'] ?>! Oto Twój profil:</h1></div>

    <?php else: ?>
        <div id="Title"><h1 id="title">Witaj username! Oto Twój profil:</h1></div>

    <?php endif; ?>
    <div id="resultContainer"></div>
    <div class="profile">
        <div class="content">
            <?
            $photoPath = "/public/uploads/usersPhotos/profile{$user['id']}.jpg";

            ?>
            <img class="profilePic"
                 src="<?= file_exists($_SERVER['DOCUMENT_ROOT'] . $photoPath) ? $photoPath : '/public/uploads/usersPhotos/default.png' ?>"
                 alt="zdj profilowe"/>

            <div id="changeProfilePicture}">
                <button type="button" id="changeProfilePicture" class="profileButton">Zmień zdjęcie profilowe</button>
            </div>

            <div class="user_data">
                <h2>Username: <?= $user['username'] ?></h2>
                <h2>Email: <?= $user['email'] ?></h2>
            </div>

            <div id="changeProfileData">
                <button type="button" class="profileButton">Zmień dane profilu</button>
            </div>
        </div>
        <div class="formContainer">
            <div class="myProfileForm">
                <form class="profileForm" id="changeProfilePictureForm" enctype="multipart/form-data">
                    <label for="profilePicture">Zmień zdjęcie profilowe:</label>
                    <input class="custom-file-input" type="file" id="profilePicture" name="profilePicture">
                    <button type="button" onclick="changeProfilePicture()" class="profileButton">Zmień</button>
                    <button type="button" id="cancelChangePicture" class="profileButton">Anuluj</button>
                </form>
            </div>
            <div class="myProfileForm">
                <form class="profileForm" id="editProfileForm">
                    <label for="editUsername">Nowa nazwa użytkownika:</label>
                    <input type="text" id="editUsername" name="editUsername">

                    <label for="editEmail">Nowy adres email:</label>
                    <input type="email" id="editEmail" name="editEmail">

                    <label for="editPassword">Nowe hasło:</label>
                    <input type="password" id="editPassword" name="editPassword">

                    <button type="button" onclick="alterProfile()" class="profileButton">Zapisz zmiany</button>
                    <button type="button" onclick="cancelEdit()" class="profileButton">Anuluj</button>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
