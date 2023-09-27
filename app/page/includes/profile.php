<main class="wrapper-profile">
    <div class="edit-profile">

        <div class="profile-avatar">
            <?php
            if ($row['images'] == null): ?>
                <img src="<?= IMAGES; ?>/no-avatar.png">
            <?php
            else: ?>
                <img src="<?= IMAGES; ?>/<?= $row['images']; ?>">
            <?php
            endif; ?>
        </div>
        <div class="avatar-upload">
            <form action="/index.php?route=edit-profile" method="post" enctype="multipart/form-data">
                <input type="file" name="avatar" id="upload" hidden>
                <?php
                if (empty($row['images'])) : ?>
                <label for="upload" class="btn btn-primary">Выбрать аватар</label>
                <input type="submit" name="download-avatar" value="Загрузить" class="btn btn-success">
                <?php else: ?>
                <input type="submit" name="delete-avatar" value="Удалить аватар" class="btn btn-danger">
                <?php endif; ?>
                <input type="hidden" name="id-avatar" value="<?= $row['id']; ?>">
                <input type="hidden" name="name-avatar" value="<?= $row['images']; ?>">
            </form>
        </div>

        <div class="profile-form">
            <form action="/index.php?route=edit-profile" method="post">
                <div class="profile-left">
                    <label for="user-name" class="label">Имя</label>
                    <input type="text" name="username" id="user-name" class="profile-input"
                           value="<?= $row['name']; ?>">
                    <br><br>
                    <label for="password" class="label">Новый пароль</label>
                    <input type="password" name="password" id="password" class="profile-input">
                </div>
                <div class="profile-right">
                    <label for="email" class="label">Email</label>
                    <input type="text" name="email" id="email" class="profile-input" value="<?= $row['email']; ?>"
                           disabled>
                    <br><br>
                    <label for="confirm-password" class="label">Потдвердить пароль</label>
                    <input type="password" name="password_confirm" id="confirm-password" class="profile-input">
                </div>
                <div>
                    <input type="submit" name="btn-save" class="btn btn-long btn-success" value="Сохранить">
                </div>
                <?php
                if (isset($_SESSION['message'])) : ?>
                <p id="message" class="msg">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    endif; ?>
                </p>
            </form>
        </div>
    </div>
</main>