<?php

$connect = mysqli_connect('localhost', 'root', '', 'todo');

if (!$connect) {
    die('Error connect to DataBase');
}