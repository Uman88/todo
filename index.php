<?php

include 'handler.php'; ?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>

    <!-- Material Icons -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>

    <!--  Custom Icons  -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="header-left">
        <div class="header-menu">
            <span class="material-symbols-outlined" id="burger-menu">menu</span>
        </div>
        <div class="header-home">
            <a href="./"><span class="material-symbols-outlined">home</span></a>
        </div>
        <div class="search">
            <div class="search-input-icon">
                <i class="material-symbols-outlined icon">search</i>
                <input type="text" placeholder="Поиск">
            </div>
        </div>
    </div>
    <div class="header-right">
        <div class="header-user" id="user-menu">
            <span class="material-symbols-outlined">person</span>
        </div>
        <!-- Open user menu -->
        <div class="user-settings">
            <ul class="user-list">
                <li class="user-list-item">
                    <span class="material-symbols-outlined">settings</span>
                    <a href="#">Профиль</a>
                </li>
                <li class="user-list-item">
                    <span class="material-symbols-outlined">logout</span>
                    <a href="#">Выход</a>
                </li>
            </ul>
        </div>
        <!-- Open user menu -->

    </div>
</header>
<!-- End Header -->
<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <span class="material-symbols-outlined">inbox</span>
            <a href="#">Входящие</a>
        </li>
        <li class="sidebar-list-item">
            <span class="material-symbols-outlined">calendar_today</span>
            <a href="#">Сегодня</a>
        </li>
        <li class="sidebar-list-item">
            <span class="material-symbols-outlined">calendar_month</span>
            <a href="#">Предстоящее</a>
        </li>
    </ul>
</aside>
<!-- End Sidebar -->
<!-- Main -->
<main class="main">
    <section class="task-list">

        <h1>
            <span class="simple-info">Сегодня</span>
            <small>
                <?php
                //echo date($days[date('N')]);

                $date = strtotime(date('Y-m-d'));
                $week = date("w", $date);

                foreach ($days as $k => $v) {
                    if ($k == $week) {
                        echo $v;
                    }
                }

                $m = date('m');
                foreach ($months as $k => $v) {
                    if ($k == $m) {
                        echo ' ' . $v . ' ';
                    }
                }
                echo $d = date('d'); ?></small>
        </h1>

        <div class="call-task-form" id="add-task">
            <span><i class="material-symbols-outlined">add</i>Добавить задачу</span>
        </div>
        <form action="./handler.php" method="post" class="hidden-task-form" id="task-form">
            <input type="text" name="name-task" id="task-form-input" placeholder="Какую задачу планируешь на сегодня?">
            <div class="action-submit">
                <input type="submit" id="cancel-task" class="btn cancel-task" value="Отмена" return false>
                <input type="submit" id="add-new-task" class="btn addtask" value="Добавить задачу" disabled>
            </div>
        </form>

        <?php
        $sql = mysqli_query($conn, "SELECT * FROM `task` ORDER BY id DESC");
        if (mysqli_num_rows($sql) > 0) :
            while ($task = mysqli_fetch_assoc($sql)) : ?>

                <div class="task" data-id="<?= $task['id']; ?>">
                    <div class="content">
                        <input type="text" class="text" id="task-text" data-id="<?= $task['id']; ?>"
                               value="<?= $task['title']; ?>" readonly>
                    </div>

                    <div class="action-button">
                        <button class="edit" data-id="<?= $task['id']; ?>">
                            <span class="material-symbols-outlined">edit</span>
                        </button>
                        <button class="delete" data-id="<?= $task['id']; ?>">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </div>

            <?php
            endwhile; endif; ?>

    </section>
</main>
<!-- End Main -->

<script src="assets/js/scripts.js"></script>
</body>
</html>