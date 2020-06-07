<?php
/**
 *  Индексный контроллер обслуживание индексной страницы приложения
 *
 */

namespace controllers;
use models\IndexModel;

class IndexController
{


    public function index($params=null)
    {
        require ('models/IndexModel.php'); // подключение модели
        $model = new IndexModel($params); // Создание экземпляра класса
        $title= $model->title; // Сбор тайтл
        $content = $model->content; // Сбор контентной части
        include ('views/index/index.php'); // подключение вида
    }

}