<?php
session_start();
require_once 'Connect.php';

// Проверка на авторизацию пользователя
if (!isset($_SESSION['user'])) {
    header('Location: ../authorization/author.php'); // Перенаправление на страницу входа
    exit;
}

$user_id = $_SESSION['user']['id'];

// Запрос для получения товаров из корзины
$query = "SELECT cart.quantity as cart_quantity, coin.id, coin.Name, coin.Price, coin.Quantity as coin_quantity
          FROM `cart`
          JOIN `coin` ON cart.coin_id = coin.id
          WHERE cart.user_id = $user_id";
$result = mysqli_query($conncet, $query);

// Инициализация переменных для подсчета итоговой суммы
$total_sum = 0;
$order_items = [];
$insufficient_stock_items = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Проверяем наличие достаточного количества товара
        if ($row['coin_quantity'] >= $row['cart_quantity']) {
            $order_items[] = $row;
            $total_sum += $row['Price'] * $row['cart_quantity'];
        } else {
            $insufficient_stock_items[] = $row;
        }
    }
} else {
    echo "Ваша корзина пуста!";
    exit;
}

// Обработка оформления заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (count($order_items) > 0) {
        // Создание записи в таблице orders
        // Создание записи в таблице orders с датой заказа
        $insert_order_query = "INSERT INTO `orders` (`user_id`, `total_price`, `order_date`) VALUES ($user_id, $total_sum, NOW())";
        mysqli_query($conncet, $insert_order_query) or die(mysqli_error($conncet));
        $order_id = mysqli_insert_id($conncet);

        // Получение даты заказа
        $order_date_query = "SELECT `order_date` FROM `orders` WHERE `id` = $order_id";
        $order_date_result = mysqli_query($conncet, $order_date_query);
        $order_date = mysqli_fetch_assoc($order_date_result)['order_date'];
        // Добавление товаров из корзины в таблицу order_items
        foreach ($order_items as $item) {
            $coin_id = $item['id'];
            $quantity = $item['cart_quantity'];
            $price = $item['Price'];
            $insert_item_query = "INSERT INTO `order_items` (`order_id`, `coin_id`, `Quantity`, `price`) 
                                  VALUES ($order_id, $coin_id, $quantity, $price)";
            mysqli_query($conncet, $insert_item_query);

            // Обновление количества монет в таблице coin
            $update_coin_query = "UPDATE `coin` SET `Quantity` = `Quantity` - $quantity WHERE `id` = $coin_id";
            mysqli_query($conncet, $update_coin_query);
        }

        // Очистка корзины пользователя
        $delete_cart_query = "DELETE FROM `cart` WHERE `user_id` = $user_id";
        mysqli_query($conncet, $delete_cart_query);

        echo "Ваш заказ успешно оформлен!";
    } else {
        echo "Ваша корзина пуста!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Оформление заказа</h1>
    
    <?php if (count($insufficient_stock_items) > 0): ?>
        <div class="error">
            <h2>Ошибка: Недостаточно товара</h2>
            <ul>
                <?php foreach ($insufficient_stock_items as $item): ?>
                    <li>Товара "<?= htmlspecialchars($item['Name']) ?>" недостаточно. Доступное количество: <?= htmlspecialchars($item['coin_quantity']) ?>. Требуемое количество: <?= htmlspecialchars($item['cart_quantity']) ?>.</li>
                <?php endforeach; ?>
            </ul>
            <a href="cart.php">Вернуться в корзину</a>
        </div>
    <?php else: ?>
        <p>Ваш заказ успешно оформлен!</p>
        <a href="../index.php">Вернуться на главную</a>
    <?php endif; ?>
</body>
</html>
