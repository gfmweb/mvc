<?php
/**
 *  Индексный контроллер обслуживание индексной страницы приложения
 *
 */

namespace controllers;
use models\IndexModel;

class IndexController
{
    /**
     * @param null $params
     */

    public function index($params=null)
    {
        if(!$_SESSION['User']){
            header('Location:/IndexController/login');
        }
        echo 'Пользователь Авторизирован';
    }
    public function login($params=null)
    {
        require ('models/IndexModel.php'); // подключение модели
        $model = new IndexModel($params); // Создание экземпляра класса
        $model->login($model); // Заполнили модель данными по ЛОГИНУ
        include ('views/index/index.php'); // подключение вида
    }

    public function register($params=null)
    {
        $model= new IndexModel();
        $model->register($model);
        include ('views/index/index.php');
    }
    public function remind($params=null)
    {
        $model= new IndexModel();
        $model->remind($model);
        include ('views/index/index.php');
    }

}