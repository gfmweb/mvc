<?php
/**
 *  Проверочный контроллер
 */

namespace controllers;

use models\ValidateAccess;
class InitController
{
    /**
     * @param null $params
     */

    public function index($params=null)
    {
       for($i=0; $i< count($params); $i++){ // Перебор массива входящих параметров для поиска ValidateFormAccess
           if($params[$i]['param']=='ValidateFormAccess'){ // Если мы нашли этот ключ
               if(ValidateAccess::IsValid($params[$i]['val'])){ // И ключ у нас подошел
                   unset($_SESSION['ValidateFormAccess']); // Сбрасываем использованный ключ
                   unset($params[$i]); // Очищаем от ненужного параметра

                   echo ('<pre>'); print_r($params); echo('</pre>'); // Вызов модели исполнения
                   break;
               }
           }

       }


    }
}