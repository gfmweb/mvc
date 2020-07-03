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
<body >

<?= $model->navbar?>

<div class="container-fluid" id="content"  >
    <?= $model->content ?>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 mt-5">
            <div class="card card-body mt-5">
                <form action="/Dver/Update" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-lg-6 mb-3">
                            <label for="validationCustom01">Изменить Имя</label>
                            <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Сменить Имя"  autofocus autocomplete="off" value="<?=$_SESSION['User_info']['name'] ?>"
                                   required>
                            <div class="valid-feedback">
                                Норм!
                            </div>
                            <div class="invalid-feedback">
                                Имя не может быть пустым
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="validationCustom01">Изменить E-mail</label>
                            <input type="email" name="UserEmail" class="form-control" id="validationCustom01" placeholder="Указать новый E-mail"   autocomplete="off" value="<?=$_SESSION['User_info']['email'] ?>"
                                   required>
                            <div class="valid-feedback">
                                Норм!
                            </div>
                            <div class="invalid-feedback">
                                Введите E-mail
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="validationCustom02">Изменить Пароль</label>
                            <input type="password" name="UserPassword" class="form-control" id="validationCustom02" placeholder="Указать новый пароль"
                            >
                            <div class="valid-feedback">
                                Норм!
                            </div>
                            <div class="invalid-feedback">
                                Введите пароль
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputGroupFile01">Изменить Аватарку</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="UserPhoto" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" value="<?=$_SESSION['ValidateFormAccess']?>" id="ValidateFormAccess" name="ValidateFormAccess" >
                        <input class="form-control" type="hidden" value="<?$_SESSION['User_info']['id'] ?>" id="ValidateFormAccess" name="UserId" >
                    </div>
                    <button class="btn btn-block blue-gradient" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom">
<?php
include('template/footer_str.php');
?>
</div>
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