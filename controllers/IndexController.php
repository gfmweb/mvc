<?php
/**
 *  Индексный контроллер обслуживание индексной страницы приложения
 *
 */

namespace controllers;
use models\IndexModel;

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
        $model = new IndexModel($params); // Создание экземпляра класса
        $model->login($model); // Заполнили модель данными по ЛОГИНУ
        include ('views/index/index.php'); // подключение вида
    }

    public function register($params=null) // Регистрация
    {
        $model= new IndexModel();
        $model->register($model);
        include ('views/index/index.php');
    }
    public function remind($params=null) // Восстановление
    {
        $model= new IndexModel();
        $model->remind($model);
        include ('views/index/index.php');
    }

    public function lk($params=null)
    {
        echo('Я личный кабинет');
    }

}