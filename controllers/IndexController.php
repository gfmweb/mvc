<?php
/**
 *  Индексный контроллер обслуживание индексной страницы приложения
 *
 */

namespace controllers;

use models\IndexModel;
use models\LkModel;

final class IndexController
{
    /**
     * @param null $params
     */



    public function index($params=null) // Вход
    {
        if(!isset($_SESSION['User'])) {
            require('models/IndexModel.php'); // подключение модели
            $model = new IndexModel(); // Создание экземпляра класса
            $model->index(); // Заполнили модель данными по ЛОГИНУ
            include('views/index/index.php'); // подключение вида
        }
        else{
            $model= new LkModel();
            $model->GenerateLk();
            include('views/lk/index.php');
        }
    }



    public function lkSettings($params=null)
    {
        $model= new LkModel();
        $model->LkSettings();
        include('views/lk/settings.php');
    }
    public function lkLogout($params=null)
    {
        session_destroy();
        header("Location: /");
    }

}