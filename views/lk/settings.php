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
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

</script>
<?=$model->script?>

</body>
</html>