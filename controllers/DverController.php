<?php
/**
 *  Проверочный контроллер
 */

namespace controllers;

use models\IndexModel;
use models\ValidateAccess;
use models\UsersAtions;

class DverController
{
    /**
     * @param null $params
     */

    public function login($params=null)
    {
       for($i=0; $i< count($params); $i++){ // Перебор массива входящих параметров для поиска ValidateFormAccess
           if($params[$i]['param']=='ValidateFormAccess'){ // Если мы нашли этот ключ
               if(ValidateAccess::IsValid($params[$i]['val'])){ // И ключ у нас подошел
                   unset($params[$i]); // Очищаем от ненужного параметра
                   if(UsersAtions::findUser($params[0]['val'])){ // Пытаемся найти пользователя по его логину
                     if(UsersAtions::CheckLogin($params[0]['val'],$params[1]['val'])){
                        $_SESSION['User']=$params[0]['val'];
                        header('Location: http://'.$_SERVER['SERVER_NAME']);
                     }
                     else{
                        header('Location: http://'.$_SERVER['SERVER_NAME'].'/IndexController/remind');
                     }
                   }
                   else{
                        header('Location: http://'.$_SERVER['SERVER_NAME'].'/IndexController/register');
                   }
                   break;
               }
               else{
                       Header('Location: http://'.$_SERVER['SERVER_NAME'].'/404.php?er_title='.urlencode("УПС! Отказ обработки формы").'&description='.urlencode("Форма не прошла проверку правомерности использования").'&action='.urlencode("<a href=\"http://".$_SERVER['SERVER_NAME']."\">Вернуться на сайт</a>"));
               }
           }

       }
    }




}