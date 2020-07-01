<?php
/**
 * Контроллер показывающий контент
 *
 *
 */


namespace controllers;

use models\ShowRoomModel;
use core\Magic;

class ShowRoomController extends Magic // Наследавание от класса Magic позволяет контроллеру обрабатывать все методы через единственный метод index
{
    /**
     * @param null $req_method
     * @param null $params
     */
    public function index($req_method=null,$params=null) // получаем запрошенный метод и параметры
    {
        $model = new ShowRoomModel(); // Создаем модель
        if($req_method!=='AjaxSearch') // Если контроллер обрабатывает обычный запрос
        {
            $model->index($req_method,$params); // Вызываем метод index
            include 'views/showroom/index.php'; // Подключаем вид
        }
        else // Если пришел Ajax запрос
        {

            $model->index($req_method,$params); // Передаем все параметры и запрошенный метод в index
            $ansver=array('content'=>$model->content_result.'</div>'.$model->pagination->pagi); // формируем массив ответа
            echo json_encode($ansver); // Отвечаем в Json формате
        }
    }
}