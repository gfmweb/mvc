<?php

/**
 *  Singletone класс подключения к БД
 *  PDO
 */

namespace config;

class Db
{

    private $_connection;
    private static $_instance;
    private static $_con;

    public static function init()
    {
        if (!self::$_instance) { // Ели у нас нет ни одного подключения к БД тогда создаем его
            self::$_instance = new self();  // Вызываем приватный метод конструктора
            self::$_con = self::$_instance->_connection; // Передаем в приватное свойство идеинтификатор подключения к БД
            self::$_con->set_charset("utf8");
            self::$_con->query("SET NAMES UTF8");
            self::$_con->query("SET CHARACTER SET UTF8");


        }
        return self::$_con; // Возвращаем Идеинтификатор
    }


    private function __construct() // приватный метод конструктора
    {
        require_once 'config.php'; // Запрашиваем config с данными для подключения к БД
        $this->_connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); // Создаем подключение

        // Обработка ошибок
        if (mysqli_connect_error()) { //Если есть ошибка
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), // Генерируем ошибку
                E_USER_ERROR);
        }
    }


    private function __clone() // Приватный ПУСТОЙ метод клон
    {
    }

    private function __wakeup() // Тоже приватный метод __wakeup
    {
    }



}