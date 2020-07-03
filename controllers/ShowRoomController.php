<?php
/**
 * Контроллер показывающий контент
 *
 *
 */


namespace controllers;

use core\ValidateAccess;
use models\ShowRoomModel;
use core\Magic;
use models\UsersActions;

class ShowRoomController extends Magic // Наследавание от класса Magic позволяет контроллеру обрабатывать все методы через единственный метод index
{
    /**
     * @param null $req_method
     * @param null $params
     */
    public function index($req_method=null,$params=null) // получаем запрошенный метод и параметры
    {
        $model = new ShowRoomModel(); // Создаем модель
        $model->index($req_method,$params); // Вызываем метод index
        if(($req_method!=='AjaxSearch')) // если запрос пришел с нашей формы
            {
                include 'views/showroom/index.php'; // Подключаем вид
            }
        else // Если пришел Ajax запрос
            {

                $ansver=array('content'=>$model->content_result.'</div>'.$model->pagination->pagi,'validator'=>$_SESSION['ValidateFormAccess']); // формируем массив ответа
                echo json_encode($ansver); // Отвечаем в Json формате
            }

    }
}