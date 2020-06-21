<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Подключаемые контроллеры
use routing\RouteController;


// Автозагрузчик классов
    spl_autoload_register(function($className) {
        $pieces = explode("\\",$className);
        if(file_exists($pieces[0]."/".$pieces[1] .'.php')){ // проверка существования контроллера
            require_once($pieces[0]."/".$pieces[1] .'.php');
        }
        else{ // Заглушка 404 в случае отсутствия обслуживающего контроллера передаем тайтл описание и возможные действия
            Header('Location: http://'.$_SERVER['SERVER_NAME'].'/404.php?er_title='.urlencode("УПС! Что-то пошло совсем не так").'&description='.urlencode("Нет такого раздела на этом сайте").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));
        }
    });

    // Имплементация
    $route = new RouteController($_REQUEST); // Подготовка к инициализации приложения --- парсинг запроса
    session_start(); // Начало работы с Сессией
    if(!isset($_SESSION['ValidateFormAccess'])){ // Если у нас не получен одноразывый ключ для работы с формой, то присваеваем его
        $_SESSION['ValidateFormAccess']=uniqid('', true); // Присвоение Одноразового пароля валидации на право отправить запрос
    }
    // Исполнение приложения
    $implement_controller = new $route->controller; // Вызов контроллера
    // Проверка на принадлежностть класса вызываемого контроллера к классу унаследованного от Magic
    $check_magic=get_parent_class($implement_controller); // Запрос родителя
    if($check_magic=="controllers\Magic"){ // Если контроллер является наследником Магического класса
        $implement_controller->index($route->method,$route->requests); // Передаем ему параметром запрашиваемй метод и запрос на его метод Index
    }
    else{
        $method=$route->method; // Запись метода контроллера
        if(method_exists($implement_controller,$method)){ // Проверка существования метода этого контроллера
            $implement_controller->$method($route->requests); // Вызов метода контроллера и передача методу всех параметров запроса
        }
        else{ // Заглушка страницы не сушествует т.к. был вызван несуществующий метод контроллера передаем тайтл описание и возможные действия
            Header('Location: http://'.$_SERVER['SERVER_NAME'].'/404.php?er_title='.urlencode("УПС! Что-то пошло немного не так").'&description='.urlencode("Нет такой странички на этом сайте").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на главную</a><hr/><a href=\"http://".$_SERVER['SERVER_NAME']."\" class='mt-3'>Вернуться в раздел</a>"));
        }
    }
