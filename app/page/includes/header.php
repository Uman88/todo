<!-- Start Header -->
<header class="header">
    <div class="header-left">
        <div class="header-menu">
            <span class="material-symbols-outlined" id="burger-menu">menu</span>
        </div>
        <div class="header-home">
            <a href="/"><span class="material-symbols-outlined">home</span></a>
        </div>
    </div>
    <div class="header-right">
        <div class="header-user" id="user-menu">
            <span class="material-symbols-outlined">person</span>
        </div>
        <!-- Open user menu -->
        <div class="user-settings">
            <?php
            $id_user = $_SESSION['user']['id'];
            $sql = "SELECT * FROM `users` WHERE `id`='$id_user'";
            $user = $conn->query($sql);
            $row = $user->fetch_assoc();
            ?>
            <div class="avatar">
                <?php
                if ($row['images'] == null): ?>
                    <img src="<?= IMAGES; ?>/no-avatar.png">
                <?php
                else: ?>
                    <img src="<?= IMAGES; ?>/<?= $row['images']; ?>">
                <?php
                endif; ?>
            </div>
            <div class="username">Привет&nbsp;<span><?= $row['name']; ?>!</span></div>
            <ul class="user-list">
                <li class="user-list-item">
                    <span class="material-symbols-outlined">settings</span>
                    <a href="/index.php?route=profile">Профиль</a>
                </li>
                <li class="user-list-item">
                    <span class="material-symbols-outlined">logout</span>
                    <a href="/index.php?route=logouts">Выход</a>
                </li>
            </ul>
        </div>
        <!-- Open user menu -->

    </div>
</header>
<!-- End Header -->