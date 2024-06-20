<?php

include 'Connect.php';
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $image=$_POST['image'];
    $ptice=$_POST['price'];
    $ransom=$_POST['ransom'];
    $quantity=$_POST['Quantity'];
    $description=$_POST['Description'];
    $id_Country=$_POST['id_Country'];
    $id_Metal=$_POST['id_Metal'];
    $Release_years=$_POST['Release_years'];
    $Nominal_value=$_POST['Nominal_value'];
    $sql="insert into `coin` ( `Name`, `Image`, `Price`, `Ransom`, `Quantity`, `Description`, `id_Country`, `id_Metal`, `Release_years`, `Nominal_value`)
    values('$name', ' $image', ' $ptice','$ransom','$quantity',' $description','$id_Country','$id_Metal','$Release_years','$Nominal_value')";
    $result =mysqli_query($conncet,$sql);
    if($result)
    {
       header('location:display.php');
    }else
    {
        die(mysqli_errno($conncet));
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
                <input type="text" class="form-control" placeholder="Введите имя" name="name" required>
            </div>
            <div class="form-group">
                <label>Картинка</label>
                <input type="text" class="form-control" placeholder="Введите URL картинки" name="image" required>
            </div>
            <div class="form-group">
                <label>Цена</label>
                <input type="number" class="form-control" placeholder="Введите цену" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Цена выкупа</label>
                <input type="number" class="form-control" placeholder="Введите цену выкупа" name="ransom" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label>Количество</label>
                <input type="number" class="form-control" placeholder="Введите количество" name="Quantity" step="1" min="0" required>
            </div>
            <div class="form-group">
                <label>Описание</label>
                <input type="text" class="form-control" placeholder="Введите описание" name="Description" required>
            </div>
            <div class="form-group">
                <label>id_Страны</label>
                <input type="number" class="form-control" placeholder="Введите id страны" name="id_Country" step="1" required>
            </div>
            <div class="form-group">
                <label>id_Металла</label>
                <input type="number" class="form-control" placeholder="Введите id металла" name="id_Metal" step="1" required>
            </div>
            <div class="form-group">
                <label>Год выпуска</label>
                <input type="number" class="form-control" placeholder="Введите год выпуска" name="Release_years" step="1" required>
            </div>
            <div class="form-group">
                <label>Номинал</label>
                <input type="number" class="form-control" placeholder="Введите номинал" name="Nominal_value" step="1" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
  </body>
</html>