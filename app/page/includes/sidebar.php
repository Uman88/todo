<!-- Start Sidebar -->
<aside class="sidebar" id="sidebar">
    <ul class="sidebar-list">
        <?php
        $sql = "SELECT * FROM `category`";
        $cats = $conn->query($sql);
        if ($cats->num_rows > 0) :
            while ($cat = $cats->fetch_assoc()) : ?>
                <li class="sidebar-list-item">
                    <?= $cat['title'] == 'Сегодня' ? '<span class="calendar-date">' . date("j") . '</span>' : ''; ?>
                    <span class="material-symbols-outlined"><?= $cat['tag']; ?></span>
                    <a href="index.php?id=<?= $cat['id']; ?>"><?= $cat['title']; ?>
                        <span class="qty-tasks">
                        <?php
                        $id_cat = $cat['id'];
                        $id_user = $_SESSION['user']['id'];
                        $sql2 = "SELECT count(*) FROM `task` WHERE `category`='$id_cat' AND `id_user`='$id_user'";
                        $count = $conn->query($sql2);
                        $num = $count->fetch_row();
                        if (!empty($num[0])) {
                            echo $num[0];
                        }
                        ?>
                        </span>
                    </a>
                </li>
            <?php
            endwhile; endif; ?>
    </ul>
</aside>
<!-- End Sidebar -->