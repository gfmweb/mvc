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



    public function index($params=null) // ОСНОВНАЯ СТРАНИЦА
    {
        if((!isset($_SESSION['User']))||(isset($_SESSION['admin']))) { // Если пользователь не авторизированый

            $model = new IndexModel(); // Создание экземпляра класса
            $model->index(); // Заполнили модель данными по ЛОГИНУ
            include('views/index/index.php'); // подключение вида
        }
        else{ // если пользователь уже выполнил вход на сайт
            $model= new LkModel(); // Модель принимает в себя данные для ЛК
            $model->GenerateLk(); // Генерируется страница ЛК
            include('views/lk/index.php'); // Подключается вид
        }
    }



    public function lkSettings($params=null) // страница изменения пользовательских настроек
    {

        $model= new LkModel(); // Модель принимает на себя данные для ЛК
        $model->LkSettings(); // Генерируется страница настроек пользователя
        include('views/lk/settings.php'); // подключается вид
    }

    public function lkLogout($params=null) // Метод выхода с сайта
    {
        session_destroy(); // Уничтожается сессия
        header("Location: /"); // перенаправляется на основную страницу сайта
    }

}