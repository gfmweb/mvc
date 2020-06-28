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
<body >
<div class="container-lg blue-gradient  text-center" style="width: 100%"> </div>


<?= $model->navbar ?>
    <div class="container-fluid "  id="materials" style="min-height: 80%">
        <?= $model->content_result ?>
    </div>

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