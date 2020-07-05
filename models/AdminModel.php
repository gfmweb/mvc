<?php


namespace models;


class AdminModel
{
    public $title;
    public function index($params=null)
    {
        $this->title='Вход в административную часть';
    }
}