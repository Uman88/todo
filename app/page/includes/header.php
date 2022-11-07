<!-- Header -->
<header class="header">
    <div class="left_control">
        <button id="burger-menu-toggle" class="left_menu_toggle btn-reset">
            <i class="ri-menu-line"></i>
        </button>
        <a href="/" class="left_home btn-reset">
            <i class="ri-home-smile-line"></i>
        </a>
        <div class="search">
            <span class="icon"><i class="ri-search-line"></i></span>
            <input type="text" id="search" class="search-input" placeholder="Поиск..."/>
        </div>
    </div>
    <div class="right_control">
        <div id="taskBtn" class="plus-task">
            <i class="ri-add-line"></i>
        </div>

        <img src="<?= IMAGES; ?>no-avatar.png" class="user-pic" alt="" onclick="toggleProfile()">
        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="<?= IMAGES; ?>no-avatar.png" alt="">
                    <div class="user-name-email">
                        <h2><?= $_SESSION['user']['name'] ?></h2>
                        <h5><?= $_SESSION['user']['email'] ?></h5>
                    </div>
                </div>
                <hr>
                <a href="/index.php?route=edit-profile" class="sub-menu-link">
                    <i class="ri-edit-line"></i>
                    <p>Профиль</p>
                    <span></span>
                </a>
                <a href="/index.php?route=logouts" class="sub-menu-link">
                    <i class="ri-logout-box-r-line"></i>
                    <p>Выход</p>
                </a>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
