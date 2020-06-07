<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
<?php
/**
 * Вид контроллера IndexController Методы использования (index)
 *
 */

?>
<?php
include('template/header_str.php');

?>
</head>
<body>

<div class="row justify-content-center mt-4">
   <div class="col-6">
     <div class="card card-body">
       <form action="/InitController/index" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-md-4 mb-3">
                   <label for="validationCustom01">Имя</label>
                   <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Имя" value="Василий"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите имя
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustom02">Фамилия</label>
                   <input type="text" name="UserLastName" class="form-control" id="validationCustom02" placeholder="Фамилия" value="Пупкин"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите Фамилию
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustomUsername">Логин</label>
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroupPrepend">@</span>
                       </div>
                       <input type="text" name="UserLogin" class="form-control" id="validationCustomUsername" placeholder="Логин"
                              aria-describedby="inputGroupPrepend" required>
                       <div class="valid-feedback">
                           Норм!
                       </div>
                       <div class="invalid-feedback">
                           Логин не выбран
                       </div>
                   </div>
               </div>
           </div>

           <div class="form-group">
               <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                   <label class="form-check-label" for="invalidCheck">
                       Принять правила и условия
                   </label>
                   <div class="invalid-feedback">
                       Вы должны принять правила и условия
                   </div>
               </div>
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Отправить</button>
       </form>
     </div>
   </div>
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
</body>
</html>