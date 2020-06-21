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

   public function index($params=null)
    {
        if(!isset($_SESSION['User'])){ // Если наш пользователь не авторизирован, то отправляем его на окно входа
            header('Location:/IndexController/login');
        }
        else
        {
            header('Location:/IndexController/lk');
        }

    }
    public function login($params=null) // Вход
    {
        require ('models/IndexModel.php'); // подключение модели
        $model = new IndexModel(); // Создание экземпляра класса
        $model->login(); // Заполнили модель данными по ЛОГИНУ
        include ('views/index/index.php'); // подключение вида
    }

    public function register($params=null) // Регистрация
    {
        $model= new IndexModel();
        $model->register();
        include ('views/index/index.php');
    }
    public function remind($params=null) // Восстановление
    {
        $model= new IndexModel();
        $model->remind();
        include ('views/index/index.php');
    }

    public function lk($params=null)
    {
       $model= new LkModel();
       $model->GenerateLk();
       include('views/lk/index.php');
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