<?php

require_once 'connection.php';

/**
 * Сортировка таска
 */
if (isset($_POST['order'])) {
    $id_tasks = $_POST['order'];

    if (is_array($id_tasks)) {
        foreach ($id_tasks as $k => $v) {
            // Инкрементирую ключ $k, для того чтобы сортировка начиналось не с 0, а 1.
            // Это сделано для того, когда добавляется задача у нее по умолчанию сортировка с 0,
            // и сама задача находится верху списка.
            $k++;
            $updateSort = "UPDATE `tasks` SET sortable='$k' WHERE id='$v'";
            mysqli_query($connect, $updateSort);
        }
    }
}

/**
 * Удаления таска
 */
if (isset($_GET['val'])) {
    $val = (int)$_GET['val'];

    if (is_numeric($val)) {
        mysqli_query($connect, "DELETE FROM `tasks` WHERE id='$val'");
    }
}