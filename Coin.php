<?php
session_start();
require_once 'Connect.php';


// Проверяем, что пользователь авторизован
if (!isset($_SESSION['user'])) {
  header('Location: ./authorization/author.php');
  exit;
}

// Проверяем, что существует GET параметр id
if (isset($_GET['id'])) {
  $coin_id = intval($_GET['id']);

  // Запрос к базе данных для получения данных о монете
  $query = "SELECT * FROM `coin` WHERE `id` = $coin_id";
  $result = mysqli_query($conncet, $query);

  // Проверяем успешность выполнения запроса и наличие данных
  if ($result && mysqli_num_rows($result) > 0) {
      $coin = mysqli_fetch_assoc($result);
  } else {
      echo "Монета не найдена";
      exit;
  }
      // Получаем название страны
      $country_query = "SELECT `Country` FROM `country` WHERE `id` = " . intval($coin['id_Country']);
      $country_result = mysqli_query($conncet, $country_query);
      $country = mysqli_fetch_assoc($country_result)['Country'];
  
      // Получаем название металла
      $metal_query = "SELECT `Metal` FROM `metal` WHERE `id` = " . intval($coin['id_Metal']);
      $metal_result = mysqli_query($conncet, $metal_query);
      $metal = mysqli_fetch_assoc($metal_result)['Metal'];
} else {
  echo "Неверный запрос";
  exit;
}
// Обработка добавления в корзину
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $quantity = isset($_POST['Quantity']) ? intval($_POST['Quantity']) : 0;

    if ($quantity > 0 && $quantity <= $coin['Quantity']) {
        // Подготовка данных для добавления в корзину
        $coin_id = mysqli_real_escape_string($conncet, $coin_id);
        $quantity = mysqli_real_escape_string($conncet, $quantity);
        $user_id = mysqli_real_escape_string($conncet, $_SESSION['user']['id']);

        // Проверка наличия записи в корзине для данного пользователя и монеты
        $check_query = "SELECT * FROM `cart` WHERE `coin_id` = $coin_id AND `user_id` = $user_id";
        $check_result = mysqli_query($conncet, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Обновление количества в корзине
            $update_query = "UPDATE `cart` SET `Quantity` = `Quantity` + $quantity WHERE `coin_id` = $coin_id AND `user_id` = $user_id";
            mysqli_query($conncet, $update_query);
        } else {
            // Добавление новой записи в корзину
            $insert_query = "INSERT INTO `cart` (`coin_id`, `user_id`, `Quantity`) VALUES ($coin_id, $user_id, $quantity)";
            mysqli_query($conncet, $insert_query);
        }
    }

    // Перенаправление на страницу с монетой после добавления в корзину
    header('Location: Coin.php?id=' . $coin_id);
    exit;
}


// Проверка подключения к базе данных
if (!$conncet) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Проверка на наличие параметра id
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conncet, $_GET['id']);
    $query = "SELECT * FROM `coin` WHERE `id` = '$id'";
    $result = mysqli_query($conncet, $query);

    // Проверка, что запрос выполнен успешно
    if ($result && mysqli_num_rows($result) > 0) {
        $coin = mysqli_fetch_assoc($result);
    } else {
        echo "Монета не найдена или запрос не выполнен";
        if ($result) {
            echo " (результаты: " . mysqli_num_rows($result) . ")";
        } else {
            echo " (ошибка: " . mysqli_error($conncet) . ")";
        }
        exit;
    }
} else {
    echo "Неверный запрос. Идентификатор не передан.";
    exit;
}



// Закрытие соединения с базой данных
mysqli_close($conncet);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$coin['Name']?></title>
    <link rel="stylesheet" href="./CoinCSS.css" />
    <link rel="stylesheet" href="./index.css" />
    <script src="./search/SearchScript.js"></script>
</head>
<body>
<meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
 <title>Магазин монет - Золотая монета</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
 <script src="./SearchScript.js"></script>

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
   
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
    <a class="a" href="./index.php" onclick="goToMainPage()">Главная</a>
    <a class="a1" href="./Cart/orders.php"> Заказы</a>
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
                    <a class=".o" href="./Cart/Cart.php">
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
 


              <div class="coin-container1">
        <div class="coin-image1">
            <img src="<?= htmlspecialchars($coin['Image']) ?>" alt="<?= htmlspecialchars($coin['Name']) ?>">
        </div>
        <div class="coin-details1">
            <h2><?= htmlspecialchars($coin['Name']) ?></h2>
            <p><strong>Цена продажи:</strong> <?= htmlspecialchars($coin['Price']) ?> ₽</p>
            <p><strong>Цена выкупа:</strong> <?= htmlspecialchars($coin['Ransom']) ?> ₽</p>
            <p><strong>Описание:</strong> <?= htmlspecialchars($coin['Description']) ?></p>
            <p><strong>Количество:</strong> <?= htmlspecialchars($coin['Quantity']) ?></p>
            <p><strong>Страна:</strong> <?= htmlspecialchars($country) ?></p>
            <p><strong>Металл:</strong> <?= htmlspecialchars($metal) ?></p>
            <p><strong>Год выпуска:</strong> <?= htmlspecialchars($coin['Release_years']) ?></p>
            <p><strong>Номинальная стоимость:</strong> <?= htmlspecialchars($coin['Nominal_value']) ?> ₽</p>

            <?php if ($coin['Quantity'] > 0): ?>
                <form action="Coin.php?id=<?= $coin_id ?>" method="post">
                    <input type="number" name="Quantity" value="1" min="1" max="<?= htmlspecialchars($coin['Quantity']) ?>">
                    <button type="submit" name="add_to_cart">Добавить в корзину</button>
                </form>
            <?php else: ?>
                <p>Товара нет в наличии</p>
            <?php endif; ?>
        </div>
        <a href="./index.php">Вернуться на главную</a>
    </div>
</body>
</html>
