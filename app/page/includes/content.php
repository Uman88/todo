<!-- Content -->
<div id="content" class="content">
    <div class="offset-content">
        <form action="/index.php?route=handler" method="post">
            <ul id="sortable" class="list-group">
                <?php $id = $_SESSION['user']['id'];
                $result = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_user`='$id' ORDER BY sortable");
                if (mysqli_num_rows($result) > 0) :
                    while ($content = mysqli_fetch_assoc($result)) :
                        if ($_GET['id'] === $content['id_category']) : ?>
                            <li class="list-group-item task" id="<?= $content['id']; ?>">
                                <i class="ri-list-check"></i>
                                <?php if ($content['priority'] == 1) : ?>
                                <label class="bubble bubble-first">
                                    <?php elseif ($content['priority'] == 2) : ?>
                                    <label class="bubble bubble-second">
                                        <?php elseif ($content['priority'] == 3) : ?>
                                        <label class="bubble bubble-third">
                                            <?php elseif ($content['priority'] == 4) : ?>
                                            <label class="bubble bubble-fourth">
                                                <?php endif; ?>
                                                <input type="radio" name="radioTask" class="radioTask"
                                                       value="<?= $content['id']; ?>">
                                                <span></span>
                                            </label>
                                            <div class="title-task"><?= $content['title']; ?></div>
                            </li>
                        <?php endif;
                    endwhile;
                endif; ?>
            </ul>
        </form>
    </div>
</div>
<!-- End of Content -->