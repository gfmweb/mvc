
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
<style type="text/css">
    /* Necessary for full page carousel*/
    html,
    body,
    header,
    .view {
        height: 100%;
    }

    /* Carousel*/
    .carousel,
    .carousel-item,
    .carousel-item.active {
        height: 100%;
    }
    .carousel-inner {
        height: 100%;
    }


    }

</style>
</head>
<body>


<div id="carousel-example-1z" class="carousel slide carousel-fade">



    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">
            <div class="view">

                <!--Video source-->
                <video class="video-intro" autoplay loop muted>
                    <source src="views/video/admin.mp4" type="video/mp4" />
                </video>

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <form id="form" action="/Dver/Adminlogin" method="post" class="needs-validation" novalidate>




                                        <input type="password"  name="AdminPassword"  id="defaultForm-pass" class="form-control" required>
                                        <label data-error="" data-success="" for="defaultForm-pass">Пароль администратора</label>

                                    <input  type="hidden" value="<?=$_SESSION['ValidateFormAccess'] ?>" id="ValidateFormAccess" name="ValidateFormAccess" >


                                    <button class="btn btn-default btn-block" type="submit">Войти</button>

                        </form>


                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/First slide-->



    </div>




</body>
</html>