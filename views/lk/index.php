<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <meta charset="UTF-8">
    <title><?= $model->title ?></title>
    <?php
    /**
     * Вид контроллера LkController Методы использования (index)
     *
     */

    ?>
    <?php
    include('template/header_str.php');

    ?>
</head>
<body>

    <?= $model->navbar?>

<div class="container-fluid" id="content" >
    <?= $model->content ?>
</div>

<?php
include('template/footer_str.php');
?>

<?=$model->script?>




</body>
</html>