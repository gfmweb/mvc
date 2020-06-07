<?php


namespace controllers;

use models\ValidateAccess;
class InitController
{
    public function __construct()
    {

    }

    public function index($params=null)
    {
       foreach($params as $param){
           if($param['param']=='ValidateFormAccess'){
               if(ValidateAccess::IsValid($param['val'])){
                   unset($_SESSION['ValidateFormAccess']);
                   echo('Всё хорошо форма от нашего пользователя');
                   echo ('<pre>'); print_r($params); echo('</pre>'); // Вызов модели исполнения
                   break;
               }
           }

       }


    }
}