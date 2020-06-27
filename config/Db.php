<?php

/**
 *  Singletone класс подключения к БД
 */

namespace config;

class Db
{

    private $_connection;
    private static $_instance; //The single instance
    private static $_con;

    public static function init()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
            self::$_con = self::$_instance->_connection;
            self::$_con->set_charset("utf8");
            self::$_con->query("SET NAMES UTF8");
            self::$_con->query("SET CHARACTER SET UTF8");

        }
        return self::$_con;
    }

    // Constructor
    private function __construct()
    {
        require_once 'config.php';
        $this->_connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }


    private function __clone()
    {
    }

    private function __wakeup()
    {
    }



}