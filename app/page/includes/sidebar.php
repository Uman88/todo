<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <nav class="nav">
        <?php $result = mysqli_query($connect, "SELECT * FROM `category`");
        if (mysqli_num_rows($result) > 0) :
            while ($category = mysqli_fetch_assoc($result)) : ?>
                <a href="/index.php?id=<?= $category['id']; ?>" class="nav__link">
            <span class="nav__icon">
                <i class="<?= $category['class']; ?>"></i>
            </span> <?= $category['title']; ?> <span class="qty_tasks">
                        <?php $id = $category['id'];
                        $res = mysqli_query($connect, "SELECT count(*) FROM `tasks` WHERE `id_category`='$id'");
                        $res = mysqli_fetch_assoc($res);
                        echo($res['count(*)']); ?>
                    </span>
                </a>
            <?php endwhile; endif; ?>
    </nav>
</div>
<!-- End of Sidebar -->