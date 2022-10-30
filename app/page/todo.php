<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <?php include 'includes/css.php'; ?>

</head>
<body>

<?php

if (isset($_SESSION['user'])) {
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/content.php';
} else {
    include 'login.php';
}


?>

<?php include 'includes/js.php'; ?>

</body>
</html>