<!DOCTYPE html>
<html lang="ru-Ru">
<head>
    <title>Контакт Контроллер</title>
    <?php
    /**
     * Вид контроллера IndexController Методы использования (index)
     *
     */

    include('template/header_str.php');

    ?>

</head>
<body >
<div class="container blue-gradient color-block  " style="width: 100%">

   <?= $pagi->pagi ?>


</div>

<script>
    $( document ).ready(function() {


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
