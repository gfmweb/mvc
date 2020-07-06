<?php


namespace controllers;

use models\AdminActions;
use models\AdminModel;
use core\ValidateAccess;


class AdminController
{
    public function index($params=null)
    {

        $model= new AdminModel($params=null);
        $model->index($params=null);
        if(!isset($_SESSION['admin'])){
            include'views/admin/index.php';
        }
        else{
            include'views/admin/admin.php';
        }

    }
    public function config($params=null)
    {
        if(ValidateAccess::ValidAccess($params))
        {
          AdminActions::config($params);
          header('Location: /admin');
        }
    }
}