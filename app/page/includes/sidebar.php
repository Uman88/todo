<!-- Start Sidebar -->
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