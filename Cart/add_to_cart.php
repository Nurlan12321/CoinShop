<?php
session_start();
require_once 'Connect.php';

if (isset($_POST['add_to_cart'])) {
    

    $coin_id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Проверка доступности товара (можете добавить свою логику проверки)

    // Добавление товара в корзину или обновление количества
    if (isset($_SESSION['cart'][$coin_id])) {
        $_SESSION['cart'][$coin_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$coin_id] = array(
            'quantity' => $quantity,
            // Дополнительные данные о товаре могут быть добавлены сюда
        );
    }

    // Редирект на страницу с описанием монеты после добавления в корзину
    header('Location: Coin.php?id=' . $coin_id);
    exit;
}
?>
