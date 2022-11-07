<!-- Content -->
<div id="content" class="content">
    <div class="offset-content">
        <form action="/index.php?route=handler" method="post">
            <ul id="sortable" class="list-group">

                <?php $id = $_SESSION['user']['id'];
                $result = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_user`='$id' ORDER BY sortable");
                if (mysqli_num_rows($result) > 0) :
                    while ($content = mysqli_fetch_assoc($result)) : ?>
                        <li class="list-group-item task">
                            <i class="ri-list-check"></i>
                            <label class="bubble bubble-first">
                                <input type="radio" name="radioTask" class="radioTask" value="<?= $content['id']; ?>">

                                <span></span>
                            </label>
                            <div class="title-task"><?= $content['title']; ?></div>
                        </li>
                    <?php endwhile; endif; ?>

            </ul>
        </form>
    </div>
</div>
<!-- End of Content -->