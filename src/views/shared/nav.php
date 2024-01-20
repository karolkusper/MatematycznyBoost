<nav>
    <img src="public/img/logo.png" alt="logo"/>
    <ul class="buttons">
        <li><a href="#MojProfil">Mój profil</a></li>
        <?php if($_SESSION['user']['role'] === 'teacher'): ?>
            <li><a href="students">Uczniowie</a></li>
        <? else: ?>
            <li><a href="user_view">Moje zadania</a></li>
        <?php endif; ?>
        <li><a href="logout" id="Wyloguj">Wyloguj się</a></li>
    </ul>
    <div class="hamburger">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-x" style="display: none"></i>
    </div>
</nav>
<script src="public/js/nav_bar.js"></script>