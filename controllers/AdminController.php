<?php


namespace controllers;

use models\AdminModel;

class AdminController
{
    public function index($params=null)
    {
        $model= new AdminModel($params=null);
        $model->index($params=null);
        include'views/admin/index.php';

    }
}