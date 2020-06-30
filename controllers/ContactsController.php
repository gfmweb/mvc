<?php


namespace controllers;

use config\Db;
use core\CRUD;
use widgets\Pagination;

class ContactsController
{
    public function index($params=null)
    {

      $db = Db::init();
      $statement=$db->prepare("SELECT * FROM `materials` WHERE autor  LIKE ?");
      $statement->bind_param("s",$query);
      $statement->execute();
      $ResultsSet= $statement->get_result();
      while($row=$ResultsSet->fetch_assoc())
      {
          $data[]=$row;
      }
      echo '<pre>'; print_r($data); echo '</pre>';
    }
}