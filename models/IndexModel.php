<?php
/**
 * модель создания индексной страницы
 *
 *
 */

namespace models;


class IndexModel
{
    /**
     * content - содержание контентной части индексной страницы
     */

    public $content;
    public $title;
    public $script;


    public function login($obj)
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

        $obj->title="Вход";
        $obj->content='<div class="row justify-content-center mt-4"><div class="container"> '.$alert.'</div>
   <div class="col-lg-6">
     <div class="card card-body">
       <form action="/DverController/login" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-lg-6 mb-3">
                   <label for="validationCustom01">E-mail</label>
                   <input type="email" name="UserEmail" class="form-control" id="validationCustom01" placeholder="email"  autofocus autocomplete="off"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите E-mail
                   </div>
               </div>
               <div class="col-lg-6 mb-3">
                   <label for="validationCustom02">Пароль</label>
                   <input type="password" name="UserPassword" class="form-control" id="validationCustom02" placeholder="Пароль" 
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите пароль
                   </div>
               </div>
               
           </div>

          
            <div class="form-group">
               
                   <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                  
              
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Войти</button>
       </form>
       <div class="form-row">
       <div class="col-lg-6 mt-3"><a href="/IndexController/register"><button class="btn btn-block btn-outline-success waves-effect">Регистрация</button></a></div>
       <div class="col-lg-6 mt-3"><a href="/IndexController/remind"><button class="btn btn-block btn-outline-secondary waves-effect">Восстановление доступа</button></a></div>
       </div>
     </div>
   </div>
</div>';
        $obj->script="";
        return $obj;
    }
    public function register($obj)
    {
        $obj->title="Регистрация";
        $obj->content='<div class="row justify-content-center mt-4">
   <div class="col-lg-6">
     <div class="card card-body">
       <form action="/DverController/register"  method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-lg-6 mb-3">
                   <label for="validationCustom01">Как Вас зовут?</label>
                   <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Представьтесь пожалуйста" autofocus
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Напишите как Вас зовут
                   </div>
               </div>
             
               <div class="col-lg-6 mb-3">
                   <label for="validationCustomUserEmail">E-mail</label>
                   <div class="input-group">
                      
                       <input type="email" name="UserEmail" class="form-control" id="validationCustomUserEmail" placeholder="Ваша почта"
                              aria-describedby="inputGroupPrepend" required>
                       <div class="valid-feedback">
                           Норм!
                       </div>
                       <div class="invalid-feedback">
                           Укажите Вашу почту
                       </div>
                   </div>
               </div>
                <div class="col-lg-12 mb-3">
                   <label for="validationCustomUserPassword">Пароль</label>
                   <div class="input-group">
                      
                       <input type="password" name="UserPassword" class="form-control" id="validationCustomUserPassword"  placeholder="Придумайте пароль"
                              aria-describedby="inputGroupPrepend" required>
                       <div class="valid-feedback">
                           Норм!
                       </div>
                       <div class="invalid-feedback">
                           Придумайте пароль
                       </div>
                   </div>
               </div>
               
           </div>

           <div class="form-group">
               <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                   <label class="form-check-label" for="invalidCheck">
                      
                   </label>
                   <span  style="cursor: pointer" data-toggle="modal" data-target="#rulsandterms"> Принять правила и условия </span>
                   <div class="invalid-feedback">
                       Вы должны принять правила и условия
                   </div>
               </div>
           </div>
            <div class="form-group">
                   <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Зарегистрироваться</button>
       </form>
       <div class="form-row">
       <div class="col-lg-6 mt-3"><a href="/IndexController/login"><button class="btn btn-block btn-outline-success waves-effect" >Вход</button></a></div>
       <div class="col-lg-6 mt-3"><a href="/IndexController/remind"><button class="btn btn-block btn-outline-secondary waves-effect">Восстановление доступа</button></a></div>
       </div>
     </div>
   </div>
</div>
<div class="modal fade" id="rulsandterms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Правила</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Понятно</button>
        
      </div>
    </div>
  </div>
</div>


';
        $obj->script='';
        return $obj;
    }
    public function remind($obj)
    {
        $obj->title="Восстановление доступа";
        $obj->content='<div class="row justify-content-center mt-4">
   <div class="col-lg-6">
     <div class="card card-body">
       <form action="/DverController/remind" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-12 mb-3">
                   <label for="validationCustom01">Ваша почта, указанная при регистрации</label>
                   <input type="email" name="UserEmail" class="form-control" id="validationCustom01" placeholder="Впишите сюда Вашу почту" autofocus autocomplete="off"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Укажите почту
                   </div>
               </div>
           </div>
            <div class="form-group">
                   <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Восстановить</button>
       </form>
       <div class="form-row">
       <div class="col-lg-6 mt-3"><a href="/IndexController/login"><button class="btn btn-block btn-outline-success waves-effect">Вход</button></a></div>
       <div class="col-lg-6 mt-3"><a href="/IndexController/register"><button class="btn btn-block btn-outline-secondary waves-effect" >Регистрация</button></a></div>
       </div>
     </div>
   </div>
</div>
        ';
        return $obj;
    }
}