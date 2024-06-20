<?php
session_start();
require_once 'Connect.php';

// Получение данных из формы и очистка от лишних пробелов
$email = trim($_POST['email']);
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$Surname = trim($_POST['Surname']);
$Name = trim($_POST['Name']);
$Middle_name = trim($_POST['Middle_name']);

// Проверка на пустоту Фамилии, Имени и Отчества
if (empty($Surname) || empty($Name) || empty($Middle_name)) {
    $_SESSION['message'] = 'Заполните все обязательные поля: Фамилия, Имя, Отчество';
    header('Location: ../Regist.php');
    exit();
}

// Запрос к базе данных для проверки существования почты
$query = "SELECT * FROM `users` WHERE `email` = '$email'";
$result = mysqli_query($connect, $query); // Исправлено на $connect, если это имя переменной для подключения

// Проверка, что запрос выполнен успешно
if ($result) {
    // Проверка наличия почты в результатах запроса
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = 'Такая почта уже существует';
        header('Location: ../Regist.php');
        exit(); // Останавливаем выполнение скрипта
    }
}

// Проверка совпадения паролей
if ($password === $password_confirm) {
    // Хэширование пароля
    $password = md5($password);

    // Вставка новой записи в базу данных
    $insert_query = "INSERT INTO `users` (`id`, `Surname`, `Name`, `Middle_name`, `email`, `password`) 
                     VALUES (NULL, '$Surname', '$Name', '$Middle_name', '$email', '$password')";
    mysqli_query($connect, $insert_query); // Исправлено на $connect

    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../author.php');
    exit(); // Останавливаем выполнение скрипта
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../Regist.php');
    exit(); // Останавливаем выполнение скрипта
}
?>
