<?php
session_start();
require_once 'Connect.php';

// Обработка поискового запроса
$search_query = '';
$search_results = [];
if (isset($_GET['search_query'])) {
    $search_query = mysqli_real_escape_string($conncet, $_GET['search_query']);
    $search_sql = "SELECT * FROM `coin` WHERE `Name` LIKE '%$search_query%'";
    $result = mysqli_query($conncet, $search_sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    } else {
        echo "Ошибка запроса: " . mysqli_error($conncet);
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
 <title>Магазин монет - Золотая монета</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
  </head>
  <body>
  <div class="div">
        <!-- Ваш текущий контент -->
        <form action="search_results.php" method="get">
            <input type="text" name="search_query" placeholder="Введите название монеты">
            <button type="submit">Поиск</button>
        </form>
    </div>
    <div class="div">
      <div class="frame-parent">
        <div class="frame-wrapper">
          <div class="frame-group">
            <div class="frame-container">
              <div class="frame-div">
                <div class="parent">
                  <a class="a">Компания</a>
                  <a class="a1"> Контакты</a>
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

                    <img
                      class="cart-basket-ui-5-svgrepo-com-1-icon"
                      loading="lazy"
                      alt=""
                      src="./public/cartbasketui5svgrepocom-1.svg"
                    />
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
              <div class="div5">Лидеры продаж</div>
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
              <h1>Результаты поиска:</h1>
        <div class="product-container">
            <?php foreach ($search_results as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['Image']) ?>" alt="Монета">
                    <p><?= htmlspecialchars($product['name']) ?></p>
                    <p>Цена: <?= htmlspecialchars($product['Price']) ?> ₽</p>
                </div>
            <?php endforeach; ?>

      </main>
      <div class="child"></div>
      <div class="div167"></div>
      <div class="div168"></div>
      <footer class="frame-footer">
        <div class="parent59">
          <img
            class="icon26"
            loading="lazy"
            alt=""
            src="./public/vector-1.svg"
          />

          <div class="frame-parent64">
            <div class="frame-parent65">
              <div class="frame-parent66">
                <div class="parent60">
                  <div class="div169">Оплата и доставка</div>
                  <main class="faq-wrapper">
                    <div class="faq">FAQ</div>
                  </main>
                  <footer class="wrapper52">
                    <div class="div170">
                      Политика обработки персональных данных
                    </div>
                  </footer>
                </div>
                <div class="copyright-2023">
                  Copyright © 2023 «ООО Абдуллаев»
                </div>
              </div>
              <div class="wrapper53">
                <div class="div171">Свидетельство пробирной палаты</div>
              </div>
            </div>
            <div class="frame-parent67">
              <div class="frame-wrapper9">
                <div class="parent61">
                  <div class="div172">+7 (812) 777–79–21</div>
                  <div class="frame-parent68">
                    <div class="whatsapp-wrapper">
                      <img
                        class="whatsapp-icon"
                        loading="lazy"
                        alt=""
                        src="./public/whatsapp.svg"
                      />
                    </div>
                    <div class="vk-wrapper">
                      <img
                        class="vk-icon"
                        loading="lazy"
                        alt=""
                        src="./public/vk.svg"
                      />
                    </div>
                    <img
                      class="instagram-icon"
                      loading="lazy"
                      alt=""
                      src="./public/instagram.svg"
                    />
                  </div>
                </div>
              </div>
              <div class="div173">+7 (812) 677–31–09</div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
