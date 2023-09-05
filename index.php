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
    <link rel="stylesheet" href="assets/css/switch.css">
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
        <?php
        $cats = mysqli_query($conn, "SELECT * FROM `category`");
        if (mysqli_num_rows($cats) > 0) :
            while ($cat = mysqli_fetch_assoc($cats)) : ?>
                <li class="sidebar-list-item">
                    <?= $cat['title'] == 'Сегодня' ? '<span class="calendar-date">' . date("j") . '</span>' : ''; ?>
                    <span class="material-symbols-outlined"><?= $cat['tag']; ?></span>
                    <a href="index.php?id=<?= $cat['id']; ?>"><?= $cat['title']; ?></a>
                </li>
            <?php
            endwhile; endif; ?>
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

        <form class="hidden-task-form" id="task-form">
            <input type="text" name="name-task" id="task-form-input" placeholder="Какую задачу планируешь на сегодня?">
            <div class="action">
                <div class="dropdown">
                    <div class="drop-title-cat">
                        <span class="material-symbols-outlined">menu</span>
                        Категории
                    </div>
                    <div id="dropdownListCat" class="dropdown-content-cat">
                        <?php
                        $cats = mysqli_query($conn, "SELECT * FROM `category`");
                        if (mysqli_num_rows($cats) > 0) :
                            while ($cat = mysqli_fetch_assoc($cats)) : ?>
                                <div id="drop-item" data-id="<?= $cat['id']; ?>">
                                    <?= $cat['title'] == 'Сегодня' ? '<span class="calendar-date">' . date(
                                            "j"
                                        ) . '</span>' : ''; ?>
                                    <span class="material-symbols-outlined"><?= $cat['tag']; ?></span>
                                    <?= $cat['title']; ?>
                                </div>
                            <?php
                            endwhile; endif; ?>
                    </div>
                </div>

                <div class="dropdown-prio">
                    <div class="drop-title-prio" data-id="">
                        <span class="wrapper-circle dropdown-circle-white"></span>
                        <span id="begin-title" class="dropdown-content-title">Приоритеты</span>
                    </div>
                    <div id="dropdownListPrio" class="dropdown-content-prio">
                        <div id="drop-item-prio" data-id="1">
                            <span class="wrapper-circle dropdown-circle-red"></span>
                            <span class="dropdown-content-title">Приоритет 1</span>
                        </div>
                        <div id="drop-item-prio" data-id="2">
                            <span class="wrapper-circle dropdown-circle-blue"></span>
                            <span class="dropdown-content-title">Приоритет 2</span>
                        </div>
                        <div id="drop-item-prio" data-id="3">
                            <span class="wrapper-circle dropdown-circle-yellow"></span>
                            <span class="dropdown-content-title">Приоритет 3</span>
                        </div>
                    </div>
                </div>

                <div class="action-submit">
                    <input type="submit" id="cancel-task" class="btn cancel-task" value="Отмена" return false>
                    <input type="submit" id="add-new-task" class="btn addtask" value="Добавить задачу" disabled>
                </div>
            </div>
        </form>

        <ul class="sortable-list">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM `task` ORDER BY sortable");
            if (mysqli_num_rows($sql) > 0) :
                while ($task = mysqli_fetch_assoc($sql)) : ?>


                    <li class="item" id="<?= $task['checkbox']; ?>" data-id="<?= $task['id']; ?>">
                        <span class="material-symbols-outlined drag" draggable="true" title="Переместить задачу">drag_indicator</span>
                        <div class="task" data-id="<?= $task['id']; ?>">

                            <div class="content">
                                <?php
                                if ($task['checkbox'] == 1) :
                                if ($task['priority'] == 1) : ?>
                                <label class="circle circle-red circle-gray" data-id="<?= $task['id']; ?>">
                                    <?php
                                    endif;
                                    if ($task['priority'] == 2) : ?>
                                    <label class="circle circle-blue circle-gray" data-id="<?= $task['id']; ?>">
                                        <?php
                                        endif;
                                        if ($task['priority'] == 3) : ?>
                                        <label class="circle circle-yellow circle-gray" data-id="<?= $task['id']; ?>">
                                            <?php
                                            endif; ?>
                                            <input type="checkbox" class="checkbox-task" id="<?= $task['id']; ?>"
                                                   checked>
                                            <span></span>
                                        </label>
                                        <input type="text" class="text text-line-through" id="task-text"
                                               data-id="<?= $task['id']; ?>"
                                               value="<?= $task['title']; ?>" readonly>
                                        <?php
                                        endif;
                                        if ($task['checkbox'] == 0) :
                                        if ($task['priority'] == 1) : ?>
                                        <label class="circle circle-red" data-id="<?= $task['id']; ?>">
                                            <?php
                                            endif;
                                            if ($task['priority'] == 2) : ?>
                                            <label class="circle circle-blue" data-id="<?= $task['id']; ?>">
                                                <?php
                                                endif;
                                                if ($task['priority'] == 3) : ?>
                                                <label class="circle circle-yellow" data-id="<?= $task['id']; ?>">
                                                    <?php
                                                    endif; ?>
                                                    <input type="checkbox" class="checkbox-task "
                                                           id="<?= $task['id']; ?>">
                                                    <span></span>
                                                </label>
                                                <input type="text" class="text" id="task-text"
                                                       data-id="<?= $task['id']; ?>"
                                                       value="<?= $task['title']; ?>" readonly>
                                                <?php
                                                endif; ?>
                            </div>

                            <div class="action-button">
                                <button class="edit" id="edit" data-id="<?= $task['id']; ?>"
                                        title="Редактировать задачу">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="delete" id="btn-delete" data-id="<?= $task['id']; ?>"
                                        title="Удалить задачу">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </div>
                    </li>
                <?php
                endwhile;
            endif;
            ?>
        </ul>
    </section>
</main>
<!-- End Main -->
<script src="assets/js/scripts.js"></script>
</body>
</html>