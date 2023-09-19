<!-- Start Content -->
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

        <form method="post" id="task-form" class="hidden-task-form">
            <input type="text" name="name-task" id="task-form-input" placeholder="Какую задачу планируешь на сегодня?">
            <div class="action">
                <div class="dropdown">
                    <div class="drop-title-cat">
                        <span class="material-symbols-outlined">menu</span>
                        Категории
                    </div>
                    <div id="dropdownListCat" class="dropdown-content-cat">
                        <?php
                        $sql1 = "SELECT * FROM `category`";
                        $cats = $conn->query($sql1);
                        if ($cats->num_rows > 0) :
                            while ($cat = $cats->fetch_assoc()) : ?>
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
            $id_url = filter_var(trim($_GET['id']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id_user = $_SESSION['user']['id'];
            $sql2 = "SELECT * FROM `task` WHERE `id_user`='$id_user' ORDER BY sortable";
            $tasks = $conn->query($sql2);
            if ($tasks->num_rows > 0) :
                while ($task = $tasks->fetch_assoc()) :
                    if ($id_url === $task['category']) :
                        ?>
                        <li class="item" id="<?= $task['checkbox']; ?>" data-id="<?= $task['id']; ?>">
                            <span class="material-symbols-outlined drag" draggable="true" title="Переместить задачу">drag_indicator</span>
                            <div class="task" data-id="<?= $task['id']; ?>">

                                <div class="content">
                                    <?php
                                    if ($task['checkbox'] == 1 && $task['priority'] == 1) :
                                    if ($task['priority'] == 1) : ?>
                                    <label class="circle circle-red circle-gray" data-id="<?= $task['id']; ?>">
                                        <?php
                                        endif;
                                        if ($task['priority'] == 2) : ?>
                                        <label class="circle circle-blue circle-gray" data-id="<?= $task['id']; ?>">
                                            <?php
                                            endif;
                                            if ($task['priority'] == 3) : ?>
                                            <label class="circle circle-yellow circle-gray"
                                                   data-id="<?= $task['id']; ?>">
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
                    endif;
                endwhile;
            endif;
            ?>
        </ul>
    </section>
</main>
<!-- End Content -->