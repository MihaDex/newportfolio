<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <? foreach ($styles as $style): ?>
        <link rel="stylesheet" href=<?= $style ?>>
    <? endforeach ?>
    <title><?= $title ?></title>
</head>
<body class="background">
<header class="head">
    <div class="container">
        <nav class="head__nav">
            <ul class="navigation-list">
                <li class="navigation-list__item navigation-list__item--active">
                    <a href="/">Главная</a>
                </li>
                <li class="navigation-list__item">
                    <a href="/news">Новости</a>
                </li>
                <li class="navigation-list__item">
                    <a href="/works">Работы</a>
                </li>
                <li class="navigation-list__item">
                    <a href="/contacts">Контакты</a>
                </li>
            </ul>
            <ul class="login-list">
                <? if(!$user): ?>
                    <li class="login-list__item">
                        <a href="/login">Войти</a>
                    </li>
                    <li class="login-list__item">
                        <a href="/register">Зарегистрироваться</a>
                    </li>
                <? else: ?>
                    <li class="login-list__item">
                        <a href="/logout">Выйти, <?= $user ?> ?</a>
                    </li>
                <? endif; ?>
            </ul>
        </nav>
        <? if($msg != false): ?>
        <div>
            <h3  class="warn"><?= $msg ?></h3>
        </div>
        <? endif; ?>
    </div>
</header>
<?= $content ?>
<footer class="floor">
    <div class="container">
        <div class="footer-items">
            <section class="contacts">
                <h2 class="contacts__header">Мои контакты</h2>
                <p class="contacts__mail">Email: dex-max89@mail.ru</p>
            </section>
            <section class="copyright">
                <span class="copyright__text">© 2019 Дементьев Михаил Георгиевич</span>
            </section>
        </div>
    </div>
</footer>
<? foreach ($scripts as $script): ?>
    <script src=<?= $script ?>></script>
<? endforeach ?>
</body>
</html>