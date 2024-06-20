<?php
$conncet = mysqli_connect(hostname: '127.0.0.1', username:'root', password:'', database:'Coin');
if(!$conncet)
{
    echo 'Что-то не так';
}