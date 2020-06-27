<?php


namespace controllers;


class ShowRoomController extends Magic
{
    public function index($req_method=null,$params=null)
    {
        echo 'Я контроллер Шоу Рум<br/>';
        echo 'Был запрошен метод:'.$req_method;
    }
}