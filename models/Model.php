<?php


namespace models;


class Model
{
    public $pages;

    public function __construct()
    {
        $this->pages=include 'config/nav_pages.php';// Сбор данных из конфигурации
    }
}