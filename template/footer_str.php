<?php
$icons = require 'config/social.php';
$social='';
foreach ($icons as $elem)
{
    foreach ($elem as $key=>$val)
    {
        $social.="<a href=\"".$val."\" target=\"_blank\">
            <i class=\"".$key." mr-3 fa-2x\"></i>
        </a>";
    }
}

?>

<footer class=" page-footer justify-content-center font-small
 wow fadeIn">
<div class="container text-center">


    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
        <?= $social ?>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
        © 2020 Copyright:
        DreamOne
    </div>
    <!--/.Copyright-->
</div>
</footer>

<script type="text/javascript" src="/views/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/views/js/popper.min.js"></script>
<script type="text/javascript" src="/views/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/views/js/mdb.min.js"></script>
<script>function HideAlerts() {  $('.alert').hide(700); }  setTimeout(HideAlerts, 3000);</script>
