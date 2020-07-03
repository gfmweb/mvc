<?php


namespace widgets;


class Navbar
{
    public static function LogoAlert($param='logo')
        /**
         * Принимает параметр того что нужно вернуть
         * по умолчанию вернет ЛОГО пользователя
         */
    {
        if($param==='logo') // Если пришел параметр ДАЙ ЛОГО пользователя
        {
            if(!isset($_SESSION['User_info']['photo'][0])) // если нет у ползователя фотографии
            {
                $logo=" <i class=\"fas fa-user\"></i>";
            }
            else{
                $logo='<img src="'.$_SESSION['User_info']['photo'].'" class="rounded-circle z-depth-0" alt="avatar image" width="45" height="40">';
            }
            return $logo;
        }
        else // Иначе возвращаем сообщение для пользователя
        {


            if(isset($_SESSION['alert']))
            {

                $alert="<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <strong>".$_SESSION['alert']."</strong> 
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                          </div>
                          ";
               unset($_SESSION['alert']);
                return $alert;
            }
            if(isset($_SESSION['success']))
            {

                $alert="<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                    <strong>".$_SESSION['success']."</strong> 
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                              </div>
                  ";
               unset($_SESSION['success']);
                return $alert;
            }


        }
    }







    public static function GetNav($active_page='Главная',$page_array,$logined=false)
    {


        require_once 'config/config.php';

        if($logined==false) // Если генерируется меню для незарегистрированого пользователя
        {

           $right_nav=' <ul class="navbar-nav nav-flex-icons">
                                       <li class="nav-item"> 
                                            <a   data-toggle="modal" data-target="#modalLoginForm" class="nav-link border border-light rounded waves-effect waves-light"
                                            ><i class="far fa-user  mr-2"></i>Вход / Регистрация
                                            </a> 
                                       </li>
                        </ul>';
        }
        else // Генерируется навбар для Залогиненного пользователя
            {
                $right_nav='<ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
           '.self::LogoAlert().'
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="/Index/lkLogout">Выйти ('.$_SESSION['User'].')</a>
        </div>
      </li>
    </ul>';
                $page_array['Мои работы']='/Index/myworks';
                $page_array['Настройки']='/Index/lksettings';
        }
            $links='';

        foreach ($page_array as $key=>$val)
        {
            if($key===$active_page)
            {
                $links.='<li class="nav-item active">
                            <a class="nav-link" href="">'.$key.'
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>';
            }
            else
            {
               $links.='<li class="nav-item">
                            <a class="nav-link" href="'.$val.'" >'.$key.'</a>
                        </li>';
            }
        }

        $nav= '<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="/" >
            <strong>' .APP_NAME.'</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
               '.$links.'
            </ul>

            <!-- Right -->
           
             '.$right_nav.'
               

        </div>

    </div>
    <div class="row justify-content-center mt-4"><div class="container">'.(self::LogoAlert('alert')).'</div>
</nav>
';

        return $nav;
    }

    public static function GetNavSh($active_page='Главная',$page_array,$logined=false,$formact=null,$placeholder=null)
    {

        if(!isset($_SESSION['User_info']['photo']))
        {
            $logo=" <i class=\"fas fa-user\"></i>";
        }
        else{
            $logo='<img src="'.$_SESSION['User_info']['photo'].'" class="rounded-circle z-depth-0" alt="avatar image" width="45" height="40">';
        }
        require_once 'config/config.php';

        if($logined==false) // Если генерируется меню для незарегистрированого пользователя
        {
            $right_nav=' <ul class="navbar-nav nav-flex-icons">
                                       <li class="nav-item"> 
                                            <a   data-toggle="modal" data-target="#modalLoginForm" class="nav-link border border-light rounded waves-effect waves-light"
                                            ><i class="far fa-user  mr-2"></i>Вход / Регистрация
                                            </a> 
                                       </li>
                        </ul>';
        }
        else // Генерируется навбар для Залогиненного пользователя
        {
            $right_nav='<ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
           '.$logo.'
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="/Index/lkLogout">Выйти ('.$_SESSION['User'].')</a>
        </div>
      </li>
    </ul>';
            $page_array['Мои работы']='/Index/myworks';
            $page_array['Настройки']='/Index/lksettings';
        }
        $links='';

        foreach ($page_array as $key=>$val)
        {
            if($key===$active_page)
            {
                $links.='<li class="nav-item active">
                            <a class="nav-link" href="">'.$key.'
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>';
            }
            else
            {
                $links.='<li class="nav-item">
                            <a class="nav-link" href="'.$val.'" >'.$key.'</a>
                        </li>';
            }
        }
        $search='<form class="form-inline mr-auto"  method="post">
                    <div class="md-form my-0">
                        <input class="form-control mr-sm-2" type="text" name="query" placeholder="Поиск" aria-label="Search" value="'.$placeholder.'" onkeyup="filterquery()">
                        <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccessAjax" name="ValidateFormAccess" >
                        <i class="fa fa-search prefix text-white"></i>
                    </div>
                </form>
    
    ';
        $nav= '<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="/" >
            <strong>' .APP_NAME.'</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
               '.$links.'
            </ul>
            '.$search.'
            <!-- Right -->
           
             '.$right_nav.'
               

        </div>

    </div>
    <div class="row justify-content-center mt-4"><div class="container">'.self::LogoAlert('alert').'</div>
</nav>
';

        return $nav;
    }
}