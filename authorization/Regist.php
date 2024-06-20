<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="./CSS/Regist.css" />
</head>
<body>
<!-- Форма авторизации-->
<form action="./vendor/singup.php" method="post">
    <label>Фамилия</label>
    <input type="text" name="Surname" placeholder="Введите свою фамилию">
    <label>Имя</label>
    <input type="text" name="Name" placeholder="Введите своё имя">
    <label>Отчество</label>
    <input type="text" name="Middle name" placeholder="Введите своё отчество">
    <label>Почта</label>
    <input type="email" name="email" placeholder="Введите адрес своей почты">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <button type="submit">Войти</button>
    <p>
        У вас есть аккаунт? - <a href="./author.php">Авторизируйтесь</a>
    </p>
    <?php
    if (isset($_SESSION['message'])) { 
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>
