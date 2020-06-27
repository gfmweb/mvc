<?php


namespace controllers;

use models\ShowRoomModel;

class ShowRoomController extends Magic
{
    public function index($req_method=null,$params=null)
    {
        $model = new ShowRoomModel();
        if($req_method!=='AjaxSearch') // Если контроллер обрабатывает обычный запрос
        {
            $model->index($req_method,$params);
            include 'views/showroom/index.php';
        }
        else // Если пришел Ajax запрос
        {
            $model->index($req_method,$params);
            $ansver=array('content'=>$model->content_result.'</div>'.$model->pagination);
            echo json_encode($ansver);
        }
    }
}