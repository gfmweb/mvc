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

</head>
<body >
    <div class="row blue-gradient color-block mb-3 mx-auto  z-depth-1-half" style="width: 100%">

    <?= $model->navbar ?>
    <div class="container-fluid" id="materials">
        <?= $model->content_result ?>
    </div>

    <div class="container-fluid" id="content" >
        <?= $model->content ?>
    </div>


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
    function filterquery(){

        let query = $('input[name="query"]').val();
            if(query.length > 0){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ShowRoomController/AjaxSearch',
                data: { 'query': query },
                success: function (data) {
                $('#materials').html(data.content);

                }
            });
            }
            else{

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/ShowRoomController/AjaxSearch',
                    data: { 'query': 'clear' },
                    success: function (data) {
                        $('#materials').html(data.content);

                    }
                });
            }
    }
</script>

</body>
</html>