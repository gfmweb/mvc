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
        $obj->title="Вход";
        $obj->content='<div class="row justify-content-center mt-4">
   <div class="col-6">
     <div class="card card-body">
       <form action="/DverController/login" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-md-6 mb-3">
                   <label for="validationCustom01">Логин</label>
                   <input type="text" name="login" class="form-control" id="validationCustom01" placeholder="Логин" value="'.$_SESSION['login'].'"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите Логин
                   </div>
               </div>
               <div class="col-md-6 mb-3">
                   <label for="validationCustom02">Пароль</label>
                   <input type="password" name="password" class="form-control" id="validationCustom02" placeholder="Пароль" 
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
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/register"> <button class="btn btn-block btn-outline-success waves-effect">Регистрация</button></a></div>
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/remind"><button class="btn btn-block btn-outline-secondary waves-effect">Восстановление доступа</button></a></div>
       </div>
     </div>
   </div>
</div>';
        $obj->script='';
        return $obj;
    }
    public function register($obj)
    {
        $obj->title="Регистрация";
        $obj->content='<div class="row justify-content-center mt-4">
   <div class="col-6">
     <div class="card card-body">
       <form action="/DverController/register" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-md-4 mb-3">
                   <label for="validationCustom01">Имя</label>
                   <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Имя" value="Василий"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите имя
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustom02">Фамилия</label>
                   <input type="text" name="UserLastName" class="form-control" id="validationCustom02" placeholder="Фамилия" value="Пупкин"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите Фамилию
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustomUsername">Логин</label>
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroupPrepend">@</span>
                       </div>
                       <input type="text" name="UserLogin" class="form-control" id="validationCustomUsername" placeholder="Логин"
                              aria-describedby="inputGroupPrepend" required>
                       <div class="valid-feedback">
                           Норм!
                       </div>
                       <div class="invalid-feedback">
                           Логин не выбран
                       </div>
                   </div>
               </div>
           </div>

           <div class="form-group">
               <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                   <label class="form-check-label" for="invalidCheck">
                      <span data-toggle="modal" style="cursor: pointer" data-target="#rulsandterms"> Принять правила и условия </span>
                   </label>
                   <div class="invalid-feedback">
                       Вы должны принять правила и условия
                   </div>
               </div>
           </div>
            <div class="form-group">
               
                   <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                  
              
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Отправить</button>
       </form>
       <div class="form-row">
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/login"><button class="btn btn-block btn-outline-success waves-effect" >Вход</button></a></div>
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/remind"><button class="btn btn-block btn-outline-secondary waves-effect">Восстановление доступа</button></a></div>
       </div>
     </div>
   </div>
</div>
<div class="modal fade" id="rulsandterms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Правила и условия</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        
      </div>
    </div>
  </div>
</div>';
        $obj->script='';
        return $obj;
    }
    public function remind($obj)
    {
        $obj->title="Восстановление доступа";
        $obj->content='<div class="row justify-content-center mt-4">
   <div class="col-6">
     <div class="card card-body">
       <form action="/DverController/register" method="post" class="needs-validation" novalidate>
           <div class="form-row">
               <div class="col-md-4 mb-3">
                   <label for="validationCustom01">Имя</label>
                   <input type="text" name="UserName" class="form-control" id="validationCustom01" placeholder="Имя" value="Василий"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите имя
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustom02">Фамилия</label>
                   <input type="text" name="UserLastName" class="form-control" id="validationCustom02" placeholder="Фамилия" value="Пупкин"
                          required>
                   <div class="valid-feedback">
                       Норм!
                   </div>
                   <div class="invalid-feedback">
                       Введите Фамилию
                   </div>
               </div>
               <div class="col-md-4 mb-3">
                   <label for="validationCustomUsername">Логин</label>
                   <div class="input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroupPrepend">@</span>
                       </div>
                       <input type="text" name="UserLogin" class="form-control" id="validationCustomUsername" placeholder="Логин"
                              aria-describedby="inputGroupPrepend" required>
                       <div class="valid-feedback">
                           Норм!
                       </div>
                       <div class="invalid-feedback">
                           Логин не выбран
                       </div>
                   </div>
               </div>
           </div>

           <div class="form-group">
               <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                   <label class="form-check-label" for="invalidCheck">
                      <span data-toggle="modal" style="cursor: pointer" data-target="#rulsandterms"> Принять правила и условия </span>
                   </label>
                   <div class="invalid-feedback">
                       Вы должны принять правила и условия
                   </div>
               </div>
           </div>
            <div class="form-group">
               
                   <input class="form-control" type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                  
              
           </div>
           <button class="btn btn-block blue-gradient" type="submit">Отправить</button>
       </form>
       <div class="form-row">
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/login"><button class="btn btn-block btn-outline-success waves-effect">Вход</button></a></div>
       <div class="col-6 mt-3"><a href="http://'.$_SERVER['SERVER_NAME'].'/IndexController/register"><button class="btn btn-block btn-outline-secondary waves-effect" >Регистрация</button></a></div>
       </div>
     </div>
   </div>
</div>
        ';
        return $obj;
    }
}