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
        $db->Delete( array('id'=>2),null,'=');


    }
}