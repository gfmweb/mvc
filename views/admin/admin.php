<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <title><?= $model->title ?></title>
    <?php
    /**
     * Вид контроллера IndexController Методы использования (index)
     *
     */

    include('template/header_str.php');

    ?>
    <style>
        body{background-color: rgba(54,154,167,0.88)}
    </style>
</head>
<main >



    <?= $model->navbar ?>
    <div class="container-fluid "  id="materials" >

    </div>
<div class="row mt-5" style="width: 100%">&nbsp</div>
    <div class="container-fluid mt-5">
       <div class="container mt-5">
           <div class="card mt-5">
               <div class="card-header text-center"><h3>Настройки DB</h3></div>
               <div class="card-body">
                   <form action="/admin/config" class="form-group" method="post">
                       <input  type="hidden" value="<?=$_SESSION['ValidateFormAccess'] ?>" id="ValidateFormAccess" name="ValidateFormAccess" >
                       <label for="DB_HOST">ХОСТ SQL</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('DB_HOST')"></i>
                       <input type="text" name="DB_HOST" id="DB_HOST" class="form-control" value="<?= DB_HOST ?>" readonly>
                       <label for="DB_NAME">Имя БД</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('DB_NAME')"></i>
                       <input type="text" name="DB_NAME" id="DB_NAME" class="form-control" value="<?= DB_NAME ?>" readonly>
                       <label for="DB_USER">Имя пользователя БД</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('DB_USER')"></i>
                       <input type="text" name="DB_USER" id="DB_USER" class="form-control" value="<?= DB_USER ?>" readonly>
                       <label for="DB_PASSWORD">Пароль пользователя БД</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('DB_PASSWORD')"></i>
                       <input type="text" name="DB_PASSWORD" id="DB_PASSWORD" class="form-control" value="<?= DB_PASSWORD ?>" readonly>
                       <hr/>
                       <h3 class="text-center">Настройки приложения</h3>
                       <label for="APP_NAME">Имя приложения</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('APP_NAME')"></i>
                       <input type="text" name="APP_NAME" id="APP_NAME" class="form-control" value="<?= APP_NAME ?>" required readonly>
                       <label for="ADMIN_PASS">Пароль администратора</label>&nbsp;<i class="fas fa-edit loginLink" onclick="edit('ADMIN_PASS')"></i>
                       <input type="text" name="ADMIN_PASS" id="ADMIN_PASS" class="form-control" value="<?= ADMIN_PASS ?>" required readonly>
                       <hr/>
                       <h3 class="text-center">Социальные кнопки</h3>
                       <div class="container justify-content-center offset-4" style="width: 30%">
                        <table class=" table table-bordered">
                            <tbody class=" table-active table-responsive-lg">
                            <?php
                                $social_content=null;
                                $social_links=require 'config/socialadmin.php';
                                foreach ($social_links as $name=>$el)
                                {
                                    foreach ($el as $icon=>$href){
                                        if($href!=='') {
                                            $social_content .= " <tr><td><input type=\"checkbox\" name=\"{$name}\" checked onchange= \"editsocial('$name')\"> <i class=\"{$icon}\"></i></td> <td><input id=\"{$name}\" type=\"text\" name=\"{$name}_href\" value='{$href}' placeholder='{$name}'>  </td></tr>";
                                        }
                                        else{
                                            $social_content .= " <tr><td><input type=\"checkbox\" name=\"{$name}\" onchange= \"editsocial('$name')\"> <i class=\"{$icon}\"></i></td> <td><input id=\"{$name}\"  type=\"text\" name=\"{$name}_href\" value='{$href}' placeholder='{$name}' readonly>  </td></tr>";
                                        }
                                    }
                                }
                                echo($social_content);
                            ?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="row card-footer justify-content-center" style="width: 100%"><button type="submit" class="btn btn-dark-green">Сохранить</button></div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <div class="page-footer" style="width: 100%">
        <?php
        include('template/footer_str.php');
        ?>
    </div>

<script>
    $( document ).ready(function() {

        <?=$model->script?>
    });
</script>
<script type="text/javascript">

    new WOW().init();
</script>
<script>
    function edit(id)
    {

        $('#'+ id).removeAttr('readonly');
    }
    function editsocial(el)
    {
        if($('#'+el).attr('readonly') == 'readonly'){
            $('#'+el).removeAttr('readonly');

        }
        else{

            $('#'+el).attr('readonly',true);
        }



    }
</script>

</body>
</html>
