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
<main style="min-height: 100%" >



<?= $model->navbar ?>
    <div class="container-fluid "  id="materials" >
        <?= $model->content_result ?>
    </div>

    <div class="container-fluid" id="content"  >
        <?= $model->content ?>
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
    function filterquery(){

        let query = $('input[name="query"]').val();
        let validator = $('#ValidateFormAccess').val();
            if(query.length > 0){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ShowRoom/AjaxSearch',
                data: { 'query': query,'ValidateFormAccess' : validator},
                success: function (data) {
                $('#materials').html(data.content);
                $('#ValidateFormAccessAjax').val(data.validator);
                    $('#ValidateFormAccess').val(data.validator);


                }
            });
            }
            else{

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/ShowRoom/AjaxSearch',
                    data: { 'query': 'clear' },
                    success: function (data) {
                        $('#materials').html(data.content);
                        $('#ValidateFormAccessAjax').val(data.validator);
                        $('#ValidateFormAccess').val(data.validator);
                    }
                });
            }
    }
</script>

</body>
</html>