<?php


namespace core;


class Model
{
    public $pages;

    public $loginModal;

    public function __construct()
    {
        $this->pages= require 'config/nav_pages.php';// Сбор данных из конфигурации

        $this->loginModal=require 'modals/main_login.php';   // Модальное окно входа
    }
}