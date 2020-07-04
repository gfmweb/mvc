<?php
/**
 * JSON ответ формы входа
 *
 *
 *
 */
return array(
    'act'=>'/Dver/login',
    'name'=>'Вход',
    'form'=>'<div class="md-form mb-5">
                                                    <i class="fas fa-envelope prefix grey-text"></i>
                                                    <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-email">Ваша почта</label>
                                                  </div>
                                                  <div class="md-form mb-4">
                                                    <i class="fas fa-lock prefix grey-text"></i>
                                                    <input type="password"  name="UserPassword"  id="defaultForm-pass" class="form-control validate" required>
                                                    <label data-error="" data-success="" for="defaultForm-pass">Ваш пароль</label>
                                                  </div>
                                                 <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >',
    'footer'=>'  <button class="btn btn-default" type="submit">Войти</button>',
    'last'=>'<div class="row justify-content-between">
                                        <span  class="loginLink"   onclick="changed(\'Регистрация\')">&nbsp;Регистрация</span>
                                        <span  class="loginLink"  onclick="changed(\'Восстановление пароля\')">Забыли пароль&nbsp;</span>
                                    </div>   ' );