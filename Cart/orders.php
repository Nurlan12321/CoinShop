<?php
session_start();
require_once 'Connect.php';

// Проверка на авторизацию пользователя
if (!isset($_SESSION['user'])) {
    header('Location: ./authorization/author.php'); // Перенаправление на страницу входа
    exit;
}

$user_id = $_SESSION['user']['id'];


// Получение информации о пользователе
$query_user = "SELECT Surname, Name, Middle_name FROM `users` WHERE id = $user_id";
$result_user = mysqli_query($conncet, $query_user);
$user = mysqli_fetch_assoc($result_user);

// Получение списка всех заказов пользователя
$query_orders = "SELECT id, total_price, order_date FROM `orders` WHERE user_id = $user_id ORDER BY order_date DESC";
$result_orders = mysqli_query($conncet, $query_orders);

$orders = [];
if ($result_orders && mysqli_num_rows($result_orders) > 0) {
    while ($row = mysqli_fetch_assoc($result_orders)) {
        $orders[] = $row;
    }
}

// Получение информации о конкретном заказе, если указан
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
$order = null;
$order_items = [];

if ($order_id > 0) {
    $query_order = "SELECT orders.id as order_id, orders.total_price, orders.order_date, users.Surname, users.Name, users.Middle_name
                    FROM `orders`
                    JOIN `users` ON orders.user_id = users.id
                    WHERE orders.id = $order_id AND orders.user_id = $user_id";
    $result_order = mysqli_query($conncet, $query_order);
    $order = mysqli_fetch_assoc($result_order);

    // Получение товаров в заказе
    $query_items = "SELECT coin.Name, order_items.Quantity, order_items.Price
                    FROM `order_items`
                    JOIN `coin` ON order_items.coin_id = coin.id
                    WHERE order_items.order_id = $order_id";
    $result_items = mysqli_query($conncet, $query_items);

    if ($result_items && mysqli_num_rows($result_items) > 0) {
        while ($row = mysqli_fetch_assoc($result_items)) {
            $order_items[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    




    <h1>Мои заказы</h1>
    <?php if ($order): ?>
        <h2>Детали заказа №<?= htmlspecialchars($order['order_id']) ?></h2>
        <p><strong>Фамилия:</strong> <?= htmlspecialchars($order['Surname']) ?></p>
        <p><strong>Имя:</strong> <?= htmlspecialchars($order['Name']) ?></p>
        <p><strong>Отчество:</strong> <?= htmlspecialchars($order['Middle_name']) ?></p>
        <p><strong>Дата заказа:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
        <p><strong>Общая сумма:</strong> <?= htmlspecialchars($order['total_price']) ?> ₽</p>

        <h3>Товары в заказе</h3>
        <table>
            <tr>
                <th>Название</th>
                <th>Количество</th>
                <th>Цена за единицу</th>
                <th>Общая стоимость</th>
            </tr>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['Name']) ?></td>
                    <td><?= htmlspecialchars($item['Quantity']) ?></td>
                    <td><?= htmlspecialchars($item['Price']) ?> ₽</td>
                    <td><?= htmlspecialchars($item['Quantity'] * $item['Price']) ?> ₽</td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="orders.php">Вернуться к списку заказов</a>
    <?php else: ?>
        <p><strong>Фамилия:</strong> <?= htmlspecialchars($user['Surname']) ?></p>
        <p><strong>Имя:</strong> <?= htmlspecialchars($user['Name']) ?></p>
        <p><strong>Отчество:</strong> <?= htmlspecialchars($user['Middle_name']) ?></p>

        <?php if (count($orders) > 0): ?>
            <table>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Общая сумма</th>
                    <th>Действия</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['total_price']) ?> ₽</td>
                        <td><a href="orders.php?order_id=<?= htmlspecialchars($order['id']) ?>">Просмотр</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>У вас нет заказов.</p>
        <?php endif; ?>
    <?php endif; ?>
    <a href="../index.php">Вернуться на главную</a>
</body>
</html>
