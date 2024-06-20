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
<form action = "./vendor/singin.php" method="post">
<label>Почта</label>
<input type="email" name ="email" placeholder="Введите свою почту">
<label>Пароль</label>
<input type="password" name= "password" placeholder="Введите пароль">
<button type="submit">Войти</button>
<p>
    У вас нет аккаунта? - <a href="./Regist.php"> Зарегистрируйтесь</a>
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