<?php
include 'Connect.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];

    $sql="delete from `coin` where id = $id";
    $res=mysqli_query($conncet,$sql);
    if($res){
        header('location:display.php');
    }else
    die(mysqli_error($conncet));
};

?>


