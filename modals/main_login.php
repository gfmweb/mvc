<?php
return '<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                        <div class="modal-dialog" role="document">
                           <form id="form" action="/Dver/login" method="post" class="needs-validation" novalidate>
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title w-100 font-weight-bold" id="FormName">Вход</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mx-3">
                                            <div class="md-form mb-5">
                                                <i class="fas fa-envelope prefix grey-text"></i>
                                                <input type="email" name="UserEmail" id="defaultForm-email" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-email">Ваша почта</label>
                                            </div>
                                            <div class="md-form mb-4">
                                                <i class="fas fa-lock prefix grey-text"></i>
                                                <input type="password"  name="UserPassword"  id="defaultForm-pass" class="form-control validate" required>
                                                <label data-error="" data-success="" for="defaultForm-pass">Ваш пароль</label>
                                            </div>
                                            <input  type="hidden" value="'.$_SESSION['ValidateFormAccess'].'" id="ValidateFormAccess" name="ValidateFormAccess" >
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                            <button class="btn btn-default" type="submit">Войти</button>
                                    </div>
                           </form>                                                          
                            <div class="container mb-3" id="last">
                                <div class="row justify-content-between">
                                    <span  class="loginLink"  onclick="changed(\'Регистрация\')">&nbsp;Регистрация</span>
                                    <span  class="loginLink" onclick="changed(\'Восстановление пароля\')">Забыли пароль&nbsp;</span>
                                </div>     
                            </div>
                        </div>
                    </div>
                   <script>
                    function changed(val)
                    {
                       $.ajax({ 
                         type: \'POST\', 
                         dataType: \'json\',
                         url: \'/Dver/changeform\', 
                         data: { \'form\': val }, 
                        success: function (data) { 
                            $(\'#FormName\').text(data.name);
                            $(\'#form\').attr(\'action\',data.act);
                            $(\'.modal-body\').html(data.form);
                            $(\'.modal-footer\').html(data.footer);
                            $(\'#last\').html(data.last);
                                }
                        });
                    }
                    </script> 
                    ';