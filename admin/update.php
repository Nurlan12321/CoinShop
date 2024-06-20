<?php

include 'Connect.php';
$id = $_GET['updateid'];
$sql = "SELECT * FROM `coin` WHERE id=$id";
$result = mysqli_query($conncet, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['Name'];
$image = $row['Image'];
$price = $row['Price'];
$ransom = $row['Ransom'];
$quantity=$row['Quantity'];
$description=$row['Description'];
$id_Country=$row['id_Country'];
$id_Metal=$row['id_Metal'];
$Release_years=$row['Release_years'];
$Nominal_value=$row['Nominal_value'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $ransom = $_POST['ransom'];
    $quantity=$_POST['Quantity'];
    $description=$_POST['Description'];
    $id_Country=$_POST['id_Country'];
    $id_Metal=$_POST['id_Metal'];
    $Release_years=$_POST['Release_years'];
    $Nominal_value=$_POST['Nominal_value'];
    $sql = "UPDATE `coin` SET name='$name', image='$image', price='$price', ransom='$ransom', Quantity='$quantity', Description='$description', id_Country='$id_Country', id_Metal='$id_Metal', Release_years='$Release_years', Nominal_value='$Nominal_value'    WHERE id=$id";
    $result = mysqli_query($conncet, $sql);
    if ($result) {
        header('location:display.php');
    } else {
        die(mysqli_error($conncet));
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container m-5">
      <form method="post">
        <div class="form-group">
          <label>Имя</label>
          <input type="text" class="form-control" placeholder="Нажмите" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="form-group">
          <label>Картинка</label>
          <input type="text" class="form-control" placeholder="Нажмите" name="image" value="<?php echo $image; ?>">
        </div>
        <div class="form-group">
          <label>Цена</label>
          <input type="number" class="form-control" placeholder="Введите цену" name="price" step="0.01" value="<?php echo $price; ?>">
        </div>
        <div class="form-group">
          <label>Цена выкупа</label>
          <input type="number" class="form-control" placeholder="Нажмите" name="ransom" step="0.01" min="0" value="<?php echo $ransom; ?>">
        </div>
        <div class="form-group">
          <label>Количество</label>
          <input type="number" class="form-control" placeholder="Введите количество" name="Quantity" step="1" min="0" value="<?php echo $quantity; ?>">
        </div>
        <div class="form-group">
          <label>Описание</label>
          <input type="text" class="form-control" placeholder="Нажмите" name="Description" value="<?php echo $description; ?>">
        </div>
        <div class="form-group">
          <label>id_Страны</label>
          <input type="number" class="form-control" placeholder="Введите количество" name="id_Country" step="1" value="<?php echo $id_Country; ?>">
        </div>
        <div class="form-group">
          <label>id_Металла</label>
          <input type="number" class="form-control" placeholder="Введите количество" name="id_Metal" step="1" value="<?php echo $id_Metal; ?>">
        </div>
        <div class="form-group">
          <label>Год выпуска</label>
          <input type="number" class="form-control" placeholder="Введите количество" name="Release_years" step="1" value="<?php echo $Release_years; ?>">
        </div>
        <div class="form-group">
          <label>Номинал</label>
          <input type="number" class="form-control" placeholder="Введите количество" name="Nominal_value" step="1" value="<?php echo $Nominal_value; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Изменить</button>
      </form>
    </div>
  </body>
</html>
