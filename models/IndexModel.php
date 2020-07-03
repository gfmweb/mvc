<?php
/**
 * модель создания индексной страницы
 *
 *
 */

namespace models;

use widgets\Navbar;
use core\Model;

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
    public $navbar;



    public function index() //Главная страница сайта если пользователь незалогинен
    {

        $this->navbar=Navbar::GetNav('Главная',require 'config/nav_pages.php',false);

        $this->title='MVC'; // Записываем Тайтл нашей страницы

        $this->content=$this->loginModal.''; // Формируем полученный НАВБАР и Активное содержимое

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
    
'; // Добавляем скрипт Валидации формы

        return $this;
    }




}