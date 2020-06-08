<?php


namespace models;
use config\Db;

class UsersAtions
{

    public static function findUser($params=null)
    {
        $ans=false;
        $db = Db::init();
        $result=$db->query("SELECT * FROM `users` WHERE `login` = '{$db->escape_string($params)}'");
        if($result){
            $ans=$result->fetch_assoc();
        }
        return $ans;
    }

    public static function CheckLogin($User)
    {

    }
}