<?php
session_start();
require_once 'Connect.php';

unset($_SESSION['user']);
header('Location: ../../index.php');
?>