<?php
/**
 * модель создания индексной страницы
 *
 *
 */

namespace models;

use models\Navbar;

class IndexModel Extends Model
{
    /**
     *  parent:: pages - содержание списка страниц проекта
     *
     * content - содержание контентной части индексной страницы
     * title -  значения Тайтл
     * script - Скрипты страницы
     * alert - Алерты страницы
     * navbar - Навигационная панель
     *
     *
     */

    public $content;
    public $title;
    public $script;
    public $alert;
    public $navbar;



    public function index() //Главная страница сайта если пользователь незалогинен
    {
        $alert=null; // Переменная в которой возможно будет храниться Алерт

        if(isset($_SESSION['alert'])) // Проверяем есть ли Алерт с ошибкой
        {
           $this->alert="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                            <strong>".$_SESSION['alert']."</strong> 
                            <button type=\"button\" class=\"close\" id='cls-but' data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>";

           unset($_SESSION['alert']); // Обнуляем записанный в сессию алерт
        }
        if(isset($_SESSION['success'])) // Проверяем есть ли алерт с Успехом
        {
            $this->alert="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <strong>".$_SESSION['success']."</strong> 
                                <button type=\"button\" class=\"close\" id='cls-but' data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                           </div>";

            unset($_SESSION['success']); // Обнуляем записанный в сессию алерт
        }


        $this->navbar = Navbar::GetNav('Главная',$this->pages,false,$this->alert); // передаем на построение верхнее меню 1-Активная страница ИМЯ 2-Массив страниц 3. Залогинены / нет 4. Алерт если он есть

        $this->title='MVC'; // Записываем Тайтл нашей страницы

        $this->content=$this->navbar.'
                    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog" role="document">
                           <form id="form" action="/DverController/login" method="post" class="needs-validation" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold" id="FormName">Вход</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                                <i class="fas fa-envelope prefix grey-text"></i>
                                                <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-email">Ваша почта</label>
                                            </div>
                                            <div class="md-form mb-4">
                                                <i class="fas fa-lock prefix grey-text"></i>
                                                <input type="password"  name="UserPassword"  id="defaultForm-pass" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-pass">Ваш пароль</label>
                                            </div>
                                            <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                            <button class="btn btn-default" type="submit">Войти</button>
                                    </div>
                           </form>                                                          
                            <div class="container mb-3" id="last">
                                <div class="row justify-content-between">
                                    <span  class="loginLink"  onclick="changed(\'Регистрация\')">&nbsp;Регистрация</span>
                                    <span  class="loginLink" onclick="changed(\'Восстановление пароля\')">Забыли пароль&nbsp;</span>
                                </div>     
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                   <script>
                   function changed(val)
                   {
                       $.ajax({ 
                         type: \'POST\', 
                         dataType: \'json\',
                         url: \'/DverController/changeform\', 
                         data: { \'form\': val }, 
                        success: function (data) { 
                            $(\'#FormName\').text(data.name);
                            $(\'#form\').attr(\'action\',data.act);
                            $(\'.modal-body\').html(data.form);
                            $(\'.modal-footer\').html(data.footer);
                            $(\'#last\').html(data.last);
                            
                            
                                }
                        });
                   }
</script> 
                    
                    
                    
                   
                   
                    
                    '; // Формируем полученный НАВБАР и Активное содержимое

        $this->script='
      
    (function() {
        \'use strict\';
        window.addEventListener(\'load\', function() {

            var forms = document.getElementsByClassName(\'needs-validation\');

            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(\'submit\', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add(\'was-validated\');
                }, false);
            });
        }, false);
    })();
    
'; // Добавляем скрипт

        return $this;
    }




}