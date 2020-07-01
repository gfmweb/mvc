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

        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #1C2331!important;
            }
        }

    </style>
</head>
<body>
<?= $model->navbar ?>

<div id="carousel-example-1z" class="carousel slide carousel-fade">

    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">
            <div class="view">

                <!--Video source-->
                <video class="video-intro" autoplay loop muted>
                    <source src="https://mdbootstrap.com/img/video/animation-intro.mp4" type="video/mp4" />
                </video>

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>MVC</strong>
                        </h1>

                        <p>
                            <strong>Заготовка MVC + MDB</strong>
                        </p>

                        <p class="mb-4 d-none d-md-block">
                            <strong>Реализованы основные задачи CRUD + Модуль регистрации / авторизации с подтверждением по Email</strong>
                        </p>


                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
            <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/77.jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>MVC</strong>
                        </h1>

                        <p>
                            <strong>Основные особенности</strong>
                        </p>

                        <p class="mb-4 d-none d-md-block">
                            <strong>Добавлен класс Magic реализующий мульти-метод </strong>
                        </p>


                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
            <div class="view">

                <!--Video source-->
                <video class="video-intro" autoplay loop muted>
                    <source src="https://mdbootstrap.com/img/video/forest.mp4" type="video/mp4" />
                </video>

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>MVC</strong>
                        </h1>

                        <p>
                            <strong>Виджеты</strong>
                        </p>

                        <p class="mb-4 d-none d-md-block">
                            <strong>Блоки NavBar и Пагинация вынесены в виджеты</strong>
                        </p>


                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->

<!--Main layout-->
<main>
    <div class="container">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-4">

                    <img src="https://mdbootstrap.com/img/Marketing/mdb-press-pack/mdb-main.jpg" class="img-fluid z-depth-1-half" alt="">

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-4">

                    <!-- Main heading -->
                    <h3 class="h3 mb-3">Bootstrap Материал Дизайн</h3>
                    <p>За основу взят Front - FrameWork
                        <strong>MDB</strong> </p>
                    <p><small>include</small> JQuery</p>
                    <!-- Main heading -->

                    <hr>

                    <p>
                        Низкий порог вхождения даст возможность даже новичкам легко изменить всю заготовку  под любые цели
                    </p>

                    <!-- CTA -->


                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Main info-->

        <hr class="my-5">

        <!--Section: Main features & Quick Start-->
        <section>

            <h3 class="h3 text-center mb-5">Основные особенности</h3>

            <!--Grid row-->
            <div class="row wow fadeIn">

                <!--Grid column-->
                <div class="col-lg-6 col-md-12 px-4">

                    <!--First row-->
                    <div class="row">
                        <div class="col-1 mr-3">
                            <i class="fas fa-code fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h5 class="feature-title">Гибкость</h5>
                            <p class="grey-text">Все настройки вынесены в отдельные config файлы</p>
                        </div>
                    </div>
                    <!--/First row-->

                    <div style="height:30px"></div>

                    <!--Second row-->
                    <div class="row">
                        <div class="col-1 mr-3">
                            <i class="fas fa-book fa-2x blue-text"></i>
                        </div>
                        <div class="col-10">
                            <h5 class="feature-title">Комметированный код</h5>
                            <p class="grey-text">Весь код PHP снабжен построчным комментарием
                            </p>
                        </div>
                    </div>
                    <!--/Second row-->

                    <div style="height:30px"></div>

                    <!--Third row-->
                    <div class="row">
                        <div class="col-1 mr-3">
                            <i class="fas fa-graduation-cap fa-2x cyan-text"></i>
                        </div>
                        <div class="col-10">
                            <h5 class="feature-title">Частые UpGrade</h5>
                            <p class="grey-text">Постоянные работы по улучшению уже имеющегося функцинала + добавление новых возможностей </p>
                        </div>
                    </div>
                    <!--/Third row-->

                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-lg-6 col-md-12">

                    <p class="h5 text-center mb-4">Краткий обзор </p>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cXTThxoywNQ" allowfullscreen></iframe>
                    </div>
                </div>
                <!--/Grid column-->

            </div>
            <!--/Grid row-->

        </section>
        <!--Section: Main features & Quick Start-->

        <hr class="my-5">

        <!--Section: Not enough-->
        <section>

            <h2 class="my-5 h3 text-center">Рассказать подробнее?</h2>

            <!--First row-->
            <div class="row features-small mb-5 mt-3 wow fadeIn">

                <!--First column-->
                <div class="col-md-4">
                    <!--First row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Защищенность</h6>
                            <p class="grey-text">Контроль над всеми входящими данными
                            </p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/First row-->

                    <!--Second row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Стабильность</h6>
                            <p class="grey-text">Анализ клиента и его действий предотвращает попытки обраиться к основным функциям через скрипты
                            </p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Second row-->

                    <!--Third row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Скорость</h6>
                            <p class="grey-text">Запросы к БД оптимизированы</p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Third row-->

                    <!--Fourth row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Легкость</h6>
                            <p class="grey-text">Все CSS и JS минимализированы</p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Fourth row-->
                </div>
                <!--/First column-->

                <!--Second column-->
                <div class="col-md-4 flex-center">
                    <img src="https://mdbootstrap.com/img/Others/screens.png" alt="MDB Magazine Template displayed on iPhone" class="z-depth-0 img-fluid">
                </div>
                <!--/Second column-->

                <!--Third column-->
                <div class="col-md-4 mt-2">
                    <!--First row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Корректность отображения</h6>
                            <p class="grey-text">Шаблоны всегда будут корректно отбражаться на любых устройствах
                            </p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/First row-->

                    <!--Second row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Современный дизайн</h6>
                            <p class="grey-text">Использование MDB позволяет создавать сайты современного оформления</p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Second row-->

                    <!--Third row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">Легкость развертывания</h6>
                            <p class="grey-text">Миграции SQL вклюены в установку
                            </p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Third row-->

                    <!--Fourth row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-check-circle fa-2x indigo-text"></i>
                        </div>
                        <div class="col-10">
                            <h6 class="feature-title">"Из коробки"</h6>
                            <p class="grey-text">После установки проект уже готов к работе</p>
                            <div style="height:15px"></div>
                        </div>
                    </div>
                    <!--/Fourth row-->
                </div>
                <!--/Third column-->

            </div>
            <!--/First row-->

        </section>
        <!--Section: Not enough-->

        <hr class="mb-5">

        <!--Section: More-->
        <section>

            <h2 class="my-5 h3 text-center">...и еще чуточку</h2>

            <!--First row-->
            <div class="row features-small mt-5 wow fadeIn">

                <!--Grid column-->
                <div class="col-xl-3 col-lg-6">
                    <!--Grid row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fab fa-firefox fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                        </div>
                        <div class="col-10 mb-2 pl-3">
                            <h5 class="feature-title font-bold mb-1">Кросс-браузерность</h5>
                            <p class="grey-text mt-2">Chrome, Firefox, IE, Safari, Opera, Microsoft Edge - MDB Одинаково хорошо работает со всеми
                            </p>
                        </div>
                    </div>
                    <!--/Grid row-->
                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-lg-6">
                    <!--Grid row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-level-up-alt fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                        </div>
                        <div class="col-10 mb-2">
                            <h5 class="feature-title font-bold mb-1">Коммулятивность апдейтов</h5>
                            <p class="grey-text mt-2">В каждый апдейт включена возможность обновления более ранней версии
                            </p>
                        </div>
                    </div>
                    <!--/Grid row-->
                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-lg-6">
                    <!--Grid row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-comments fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                        </div>
                        <div class="col-10 mb-2">
                            <h5 class="feature-title font-bold mb-1">Сообщество</h5>
                            <p class="grey-text mt-2">Большинство вопросов по проекту активно обсуждаются в  социальных сетях
                            </p>
                        </div>
                    </div>
                    <!--/Grid row-->
                </div>
                <!--/Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-lg-6">
                    <!--Grid row-->
                    <div class="row">
                        <div class="col-2">
                            <i class="fas fa-cubes fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                        </div>
                        <div class="col-10 mb-2">
                            <h5 class="feature-title font-bold mb-1">Модульность</h5>
                            <p class="grey-text mt-2">Дополнительные модули можно подключать отдельно не затрагивая основной каркас приложения.</p>
                        </div>
                    </div>
                    <!--/Grid row-->
                </div>
                <!--/Grid column-->

            </div>
            <!--/First row-->

            <!--Second row-->

            <!--/Second row-->

        </section>
        <!--Section: More-->

    </div>
</main>
    <div class="container-fluid" id="content" >
        <?= $model->content ?>
    </div>

<?php
include('template/footer_str.php');
?>
<script>
$( document ).ready(function() {

<?=$model->script?>
});
</script>
    <script type="text/javascript">

        new WOW().init();
    </script>
</body>
</html>