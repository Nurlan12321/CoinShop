<?php
session_start();
require_once 'Connect.php';

// Получение данных из формы
$email = $_POST['email'];
$password = md5($_POST['password']);
$check_user = mysqli_query($conncet, query:"SELECT * FROM `users` where `email` = '$email' and `password` = '$password'");
 // Проверка на правильность ввода email и пароля
 if ($email === 'edik.abdullin1996@mail.ru' && $password === '202cb962ac59075b964b07152d234b70') { 
    // Перенаправление на другую страницу
    header('Location: ../../admin/display.php');
    exit;
}
else if (mysqli_num_rows($check_user)>0)
{
    $user = mysqli_fetch_assoc($check_user);
$_SESSION['user']=[    
    "id"=> $user['id'],
    "email"=> $user['email']
    
];
header('Location: ../../index.php');

}
else {
    $_SESSION['message'] = 'Неверная почта или пароль';
    header('Location: ../author.php');
}
?>