<?php
session_start();
require_once 'Connect.php';

// Проверка на авторизацию пользователя
if (!isset($_SESSION['user'])) {
    header('Location: ../authorization/author.php'); // Перенаправление на страницу входа
    exit;
}

$user_id = $_SESSION['user']['id'];

// Обработка удаления из корзины
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $coin_id = intval($_POST['coin_id']);

    // Удаление записи из корзины
    $delete_query = "DELETE FROM `cart` WHERE `coin_id` = $coin_id AND `user_id` = $user_id";
    mysqli_query($conncet, $delete_query);
}

// Запрос для получения товаров из корзины
$query = "SELECT cart.Quantity, coin.Name, coin.Price, coin.Image, coin.id 
          FROM `cart`
          JOIN `coin` ON cart.coin_id = coin.id
          WHERE cart.user_id = $user_id";
$result = mysqli_query($conncet, $query);

// Инициализация переменных для подсчета итоговой суммы
$total_sum = 0;

$cart_items = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = $row;
        $total_sum += $row['Price'] * $row['Quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../search/SearchScript cart.js"></script>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />

</head>
<body>
<div class="search-bar">
    <input type="text" id="search-input" class="search-input" placeholder="Поиск товаров...">
    <button onclick="performSearch()">Искать</button>
    <button onclick="toggleSearchBar()">Выход</button>
</div>  
    <div class="div">
      <div class="frame-parent">
        <div class="frame-wrapper">
          <div class="frame-group">
            <div class="frame-container">
              <div class="frame-div">
              <div class="parent">
    <a class="a" href="../index.php" onclick="goToMainPage()">Главная</a>
    <a class="a1" href="./orders.php"> Заказы</a>
</div>


              </div>
              <div class="frame-parent1">
                <div class="image-3-parent">
                  <img
                    class="image-3-icon"
                    loading="lazy"
                    alt=""
                    src="./public/image-3@2x.png"
                  />

                  <div class="wrapper">
                    <a class="a2">
                      <p class="p">Золотая</p>
                      <p class="p1">Монета</p>
                    </a>
                  </div>
                </div>
                <div class="frame-wrapper1">
                  <div class="group">
                    <a class="a3">+7 (812) 777–79–21</a>
                    <div class="div1">+7 (812) 677–31–09</div>
                  </div>
                </div>
                <header class="search-svgrepo-com-1-wrapper" onclick="toggleSearchBar()">
    <img class="search-svgrepo-com-1-icon" loading="lazy" alt="" src="./public/searchsvgrepocom-1.svg" />
</header>
                <div class="frame-wrapper2">
                  <div class="heart-svgrepo-com-1-parent">
                    <img
                      class="heart-svgrepo-com-1-icon"
                      loading="lazy"
                      alt=""
                      src="./public/heartsvgrepocom-1.svg"
                    />

                    <a class=".o" href="./cart.php">
    <img class="cart-basket-ui-5-svgrepo-com-1-icon" loading="lazy" alt="" src="./public/cartbasketui5svgrepocom-1.svg" />

</a>
                  </div>
                </div>
                <div class="container">
        <?php if (isset($_SESSION['user'])): ?>
            <span class="div2"><?php echo $_SESSION['user']['email']; ?></span>
            <a href="./authorization/vendor/logout.php" class="logout">Выход</a>
        <?php else: ?>
            <a class="div2" href="./authorization/author.php">Войти</a>
        <?php endif; ?>
    </div>
              </div>
            </div>
            <div class="frame">
              <img
                class="icon"
                loading="lazy"
                alt=""
                src="./public/vector-1.svg"
              />
            </div>
          </div>
        </div>
        <div class="parent1">
          <img class="icon1" alt="" src="./public/-@2x.png" />

          <div class="frame-wrapper3">
            <div class="parent2">
              <div class="div3"></div>
              <div class="div4"></div>
            </div>
          </div>
        </div>
      </div>
      <main class="inner">
        <div class="frame-parent2">
          <div class="frame-parent3">
          <div class="wrapper1">
    <div class="div5"><?php echo isset($_GET['search']) ? 'Результаты поиска' : 'Ваша корзина'; ?></div>
</div>
            <div class="frame-parent4">
              <div class="frame-wrapper4">
                <div class="frame-parent5">
                  <div class="parent3">
                    <div class="div6">Инвестиционные</div>
                    <div class="div7">Памятные</div>
                    <div class="div8">Нумизматика</div>
                  </div>
                  <div class="parent4">
                    <u class="u">Металл</u>
                    <div class="div9">Золото</div>
                    <div class="div10">Серебро</div>
                    <div class="div11">Платина</div>
                    <div class="div12">Палладий</div>
                    <div class="div13">Золото/Серебро</div>
                  </div>
                  <div class="parent5">
                    <u class="u1">Страна</u>
                    <div class="wrapper2">
                      <div class="div14">Австралия</div>
                    </div>
                    <div class="div15">Австрия</div>
                    <div class="div16">Великобритания</div>
                    <div class="div17">Канада</div>
                    <div class="div18">Китай</div>
                    <div class="div19">Мексика</div>
                    <div class="div20">Россия</div>
                    <div class="div21">Россия до 1917</div>
                    <div class="div22">США</div>
                    <div class="div23">ЮАР</div>
                    <div class="div24">Прочие &gt;</div>
                  </div>
                  <div class="parent6">
                    <u class="u2">Вес</u>
                    <div class="div25">1000 гр.</div>
                    <div class="oz">311 гр. (10 oz)</div>
                    <div class="oz1">155.5 гр. (5 oz)</div>
                    <div class="oz2">62.2 гр. (2 oz)</div>
                    <div class="oz3">31.1 гр. (1 oz)</div>
                    <div class="oz4">15.55 гр. (1/2 oz)</div>
                    <div class="oz5">7.78 гр. (1/4 oz)</div>
                    <div class="oz6">3.11 гр. (1/10 oz)</div>
                    <div class="div26">Прочие</div>
                  </div>
                  <u class="u3">Наборы</u>
                </div>
              </div>


    <?php if (count($cart_items) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Итого</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['Image']) ?>" alt="<?= htmlspecialchars($item['Name']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($item['Name']) ?></td>
                        <td><?= htmlspecialchars($item['Price']) ?> ₽</td>
                        <td><?= htmlspecialchars($item['Quantity']) ?></td>
                        <td><?= htmlspecialchars($item['Price'] * $item['Quantity']) ?> ₽</td>
                        <td>
                            <form action="cart.php" method="post">
                                <input type="hidden" name="coin_id" value="<?= $item['id'] ?>">
                                <button class="btn btn-danger" type="submit" name="remove_from_cart">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Итоговая сумма: <?= $total_sum ?> ₽</h2>
        <form action="checkout.php" method="post">
            <button class="btn btn-primary" type="submit" name="checkout">Оформить заказ</button>
        </form>
    <?php else: ?>
        <p>Ваша корзина пуста</p>
    <?php endif; ?>
</body>
</html>
