<?php
/**
 * JSON ответ формы восстановления пароля
 *
 *
 *
 */

return array('act'=>'/Dver/remind',
    'name'=>'Восстановление пароля',
    'form'=>'<div class="md-form mb-5">
                                            <div class="md-form mb-2">
                                                <i class="fas fa-envelope prefix grey-text"></i>
                                                <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-email">Ваша почта указанная при регистрации</label>
                                            </div> 
                                             <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                                            
                                            ',
    'footer'=>'<button class="btn btn-default" type="submit">Восстановить</button>',
    'last'=>'<div class="row justify-content-between">
                                        <span  class="loginLink"   onclick="changed(\'Вход\')">&nbsp;Вход</span>
                                        <span  class="loginLink"  onclick="changed(\'Регистрация\')">Регистрация&nbsp;</span>
                                    </div>' );