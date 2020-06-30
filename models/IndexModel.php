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
    public $alert;
    public $navbar;



    public function index() //Главная страница сайта если пользователь незалогинен
    {

        $this->navbar = Navbar::GetNav('Главная',$this->pages,false,$this->alert); // передаем на построение верхнее меню 1-Активная страница ИМЯ 2-Массив страниц 3. Залогинены / нет 4. Алерт если он есть

        $this->title='MVC'; // Записываем Тайтл нашей страницы

        $this->content=$this->navbar.$this->loginModal.''; // Формируем полученный НАВБАР и Активное содержимое

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