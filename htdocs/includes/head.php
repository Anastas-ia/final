<!-- Шапка -->
<header class="header-wrap">
    <div class="header-logo">
        <a class="site-logo" href="../index.php">
            <img src="images/logo.png" alt="logo">
        </a>
    </div>
    <nav class="header-nav-wrap">
        <ul id="navbar" class="header-main-nav">
            <li><a href="../index.php" class="nav-link active">Главная</a></li>
            <li><a href="../index.php#gallery" class="nav-link">Галерея</a></li>
            <li><a href="../index.php#contact" class="nav-link">Контакты</a></li>
            <?if (isset($user) and $user > 0){?>
            <li><a href="<?=$uri?>/profile.php" class="nav-link"><span class="user-text"><?=$user['LOGIN']?></span></a></li>
            <?}else{?>
            <li><a href="<?=$uri?>/login.php" class="nav-link"><span class="user-text">Вход</span></a></li>
            <li><a href="<?=$uri?>/reg.php" class="nav-link"><span class="user-text">Регистрация</span></a></li>
            <?}?>
        </ul>
    </nav>

</header>