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
        $db = new CRUD('materials');
        $data=$db->GetInfo()->Resulting;
        for($i=0; $i < 500; $i++)
        {
            $data[]=$data[rand(0,9)];
        }
        for($i=0, $iMax = count($data); $i< $iMax; $i++)
        {
            $db->Add(array('title'=>$data[$i]['title'],'description'=>$data[$i]['description'],'content'=>$data[$i]['content'],'trumb'=>$data[$i]['trumb'],'img'=>$data[$i]['img'],'link'=>$data[$i]['link'],'autor'=>$data[$i]['autor'],'ismoderate'=>$data[$i]['ismoderate']));
        }

    }
}