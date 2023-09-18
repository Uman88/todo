<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "todo";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}