<?php


namespace models;




class LkModel
{
    public $content;
    public $title;
    public $script;
    public $navbar;

    private static function LogoAlert($param='logo')
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
                $alert=null;
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
                }
                return $alert;
            }
    }

    public function GenerateLk() // Индексная страница личного кабинета
    {
        $this->title='Личный кабинет';
        $this->navbar='<nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
                          <a class="navbar-brand" href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="mdb logo"> MVC</a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                            aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                            <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                <a class="nav-link" href="/IndexController/lk">Личный кабинет
                                  <span class="sr-only">(current)</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="/IndexController/lkSettings">Настройки</a>
                              </li>
                            </ul>
                            <ul class="navbar-nav ml-auto nav-flex-icons">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                  '.self::LogoAlert().'
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right dropdown-default"
                                  aria-labelledby="navbarDropdownMenuLink-333">
                                  <a class="dropdown-item" href="/IndexController/lkLogout">Выйти ('.$_SESSION['User'].')</a>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </nav>';
        $this->content=self::LogoAlert('alert').'';
    }

    public function LkSettings() // Страница настроек
    {
        $this->title='Настройки';
        $this->navbar='<nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
                          <a class="navbar-brand" href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="mdb logo"> MVC</a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                            aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                            <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                <a class="nav-link" href="/IndexController">Личный кабинет</a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link" href="/IndexController/lkSettings">Настройки</a>
                                 <span class="sr-only">(current)</span>
                              </li>
                            </ul>
                            <ul class="navbar-nav ml-auto nav-flex-icons">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">
                                   '.self::LogoAlert().'
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg-right dropdown-default"
                                  aria-labelledby="navbarDropdownMenuLink-333">
                                  <a class="dropdown-item" href="/IndexController/lkLogout">Выйти ('.$_SESSION['User'].')</a>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </nav>';
        $this->content=self::LogoAlert('alert').'<div class="row justify-content-center mt-4"><div class="container"> '.self::LogoAlert('alert').'</div>
                           <div class="col-lg-6">
                             <div class="card card-body">
                               <form action="/Dver/Update" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                   <div class="form-row">
                                       <div class="col-lg-6 mb-3">
                                           <label for="validationCustom01">Изменить Имя</label>
                                           <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Сменить Имя"  autofocus autocomplete="off" value="'.$_SESSION['User_info']['name'].'"
                                                  required>
                                           <div class="valid-feedback">
                                               Норм!
                                           </div>
                                           <div class="invalid-feedback">
                                               Имя не может быть пустым
                                           </div>
                                       </div>
                                       <div class="col-lg-6 mb-3">
                                           <label for="validationCustom01">Изменить E-mail</label>
                                           <input type="email" name="UserEmail" class="form-control" id="validationCustom01" placeholder="Указать новый E-mail"   autocomplete="off" value="'.$_SESSION['User_info']['email'].'"
                                                  required>
                                           <div class="valid-feedback">
                                               Норм!
                                           </div>
                                           <div class="invalid-feedback">
                                               Введите E-mail
                                           </div>
                                       </div>
                                       <div class="col-12 mb-3">
                                           <label for="validationCustom02">Изменить Пароль</label>
                                           <input type="password" name="UserPassword" class="form-control" id="validationCustom02" placeholder="Указать новый пароль" 
                                                  >
                                           <div class="valid-feedback">
                                               Норм!
                                           </div>
                                           <div class="invalid-feedback">
                                               Введите пароль
                                           </div>
                                       </div>
                                       <div class="col-12 mb-3">
                                       <label for="inputGroupFile01">Изменить Аватарку</label>
                                           <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="UserPhoto" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
                                                </div>
                                            </div>
                                       </div>
                                   </div>
                                    <div class="form-group">
                                           <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                                           <input class="form-control" type="hidden" value="'.$_SESSION['User_info']['id'].'" id="ValidateFormAccess" name="UserId" >
                                   </div>
                                   <button class="btn btn-block blue-gradient" type="submit">Сохранить</button>
                               </form>
                             </div>
                           </div>
                        </div>';
    }
}