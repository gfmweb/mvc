<?php


namespace controllers;

use config\Db;
use models\CRUD;
use models\Pagination;

class ContactsController
{
    public function index($params=null)
    {
      /*$db = Db::init();
       $title=array('Природа','Работа','Отношения','Вино','Космос','Игры','Люди','Животные','Программирование','Еда','Учеба','PHP','SQL','Bootstrap','Машины','Стиль','Спорт','Вода','Осень','Лето','Coca-Cola','Мебель','Плакаты','Социум');
       $autors=array('Гофман','Петрик','Воронцов','Ларионов','Косова','Тужилова','Ковалёва');
       $description='Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
       $content=array('   <div class="col-lg-4 col-md-4 mt-5">

            <div class="view overlay z-depth-5">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(115).jpg" class="img-fluid" alt="">
                <a>
                    <div class="mask rgba-white-light"></div>
                </a>
            </div>

        </div>
     ',' <div class="col-lg-4 col-md-4 mt-5">

            <div class="view overlay z-depth-5">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(116).jpg" class="img-fluid" alt="">
                <a>
                    <div class="mask rgba-white-light"></div>
                </a>
            </div>

        </div>',
           ' <div class="col-lg-4 col-md-4 mt-5">

            <div class="view overlay z-depth-5">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(117).jpg" class="img-fluid" alt="">
                <a>
                    <div class="mask rgba-white-light"></div>
                </a>
            </div>

        </div>');
       $trumbs=array(' <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(115).jpg" class="img-fluid" alt="">',' <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(116).jpg" class="img-fluid" alt="">',' <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img(117).jpg" class="img-fluid" alt="">');
       $links=array('/ShowController/show?id=1','/ShowController/show?id=2','/ShowController/show?id=3');

       for($i=0; $i < 2; $i++)
       {
           $db->query("INSERT INTO `materials` SET 
            `title`       = '".$title[rand(0,count($title)-1)]."',
            `description` = '".$description."',
            `content`     = '".$content[rand(0,count($content)-1)]."',
            `trumb`       = '".$trumbs[rand(0,count($trumbs)-1)]."',
            `img`         = '".$trumbs[rand(0,count($trumbs)-1)]."', 
            `link`        = '".$links [rand(0,count($links)-1)]."',
            `autor`       = '".$autors[rand(0,count($autors)-1)]."'
            ") or die($db->error);
       }*/
$db = new CRUD('materials'); echo'<pre>';

$db->GetInfo(array('title','autor'),'OR','=','all','Гофман');

include 'views/contact/index.php';
    }
}