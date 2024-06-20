<?php

include 'Connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
    <title>Присовение</title>
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="user.php" class="text-light  "> Добавить монету </a>  
        <button class="btn btn-primary my-5"><a href="../index.php" class="text-light  "> Выйти </a>  
    </button>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Имя</th>
      <th scope="col">Картинка</th>
      <th scope="col">Цена</th>
      <th scope="col">Цена выкупа</th>
      <th scope="col">Количество</th>
      <th scope="col">Описание</th>
      <th scope="col">id_Страны</th>
      <th scope="col">id_Металла</th>
      <th scope="col">Годы выпуска</th>
      <th scope="col">Номинал</th>
    </tr>
  </thead>
  <tbody>
  
  <?php
                $sql = "SELECT * FROM `coin`";
                $result = mysqli_query($conncet, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id=$row['id'];
                      $name=$row['Name'];
                      $image=$row['Image'];
                      $price=$row['Price'];
                      $ransom=$row['Ransom'];
                      $quantity=$row['Quantity'];
                      $description=$row['Description'];
                      $id_Country=$row['id_Country'];
                      $id_Metal=$row['id_Metal'];
                      $Release_years=$row['Release_years'];
                      $Nominal_value=$row['Nominal_value'];

                      echo '<tr>
                      <th score="row">'.$id.'</th>
                      <td>'. $name.'</td>
                      <td>'. $image.'</td>
                      <td>'. $price.'</td>
                      <td>'. $ransom.'</td>
                      <td>'. $quantity.'</td>
                      <td>'.  $description.'</td>
                      <td>'.  $id_Country.'</td>
                      <td>'.  $id_Metal.'</td>
                      <td>'. $Release_years.'</td>
                      <td>'.  $Nominal_value.'</td>
                      <td>
<button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Обновить</a></button>
<button class="btn btn-danger"><a href="delete.php?id='.$id.'"  class="text-light">Удалить</a></button>
</td>
                      </tr>';
                    }
                } 
                ?>

  </tbody>
</table>    
</div>
   
</body>
</html>