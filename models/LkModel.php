<?php


namespace models;

use widgets\Navbar;


class LkModel
{
    public $content;
    public $title;
    public $script;
    public $navbar;


    public function GenerateLk() // Индексная страница личного кабинета
    {
        $this->title='Личный кабинет';
        $this->navbar=Navbar::GetNav('Главная',require 'config/nav_pages.php',true);
        $this->content='';
    }

    public function LkSettings() // Страница настроек
    {
        $this->title='Настройки';
        $this->navbar=Navbar::GetNav('Настройки',require 'config/nav_pages.php',true);;
        $this->content='';
    }
}