<?php

$conn = new mysqli("localhost", "root", "", "laba2") or die('Connection error to db.');

if (!$conn) {
    echo "Ошибка: Невозможно установить соединение с MySQL.";
    echo "Код ошибки errno: " . mysqli_connect_errno();
    echo "Текст ошибки error: " . mysqli_connect_error();
    exit;
}


