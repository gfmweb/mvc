<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <title><?= $model->title ?></title>
    <?php
    /**
     * Вид контроллера IndexController Методы использования (index)
     *
     */

    include('template/header_str.php');

    ?>
    <style>
        body{background-color: rgba(54,154,167,0.88)}
    </style>
</head>
<body >
<div class="container-lg blue-gradient  text-center" style="width: 100%"> </div>


<?= $model->navbar ?>
<div class="container-fluid "  id="materials" style="min-height: 80%">

</div>

<div class="container-fluid" id="content" >
    <?= $model->content ?>
</div>

<?php
include('template/footer_str.php');
?>

<?=$model->script?>




</body>
</html>