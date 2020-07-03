<?php
/**
 * Контроллер страницы контакты
 *
 */

namespace controllers;


use core\CRUD;
use widgets\Pagination;

class ContactsController
{
    public function index($params=null)
    {
        $db = new CRUD('test');
        $db->Update( array('name'=>'Senior','lastname'=>'Developer'),null,'=',array('id'=>'1'));


    }
}