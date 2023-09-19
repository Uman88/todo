<!-- Start Header -->
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
            <div class="user-avatar"><img src="<?= IMAGES; ?>/no-avatar.png"></div>
            <div class="username">Привет&nbsp;<span>Uman!</span></div>
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