<?php
ob_start();
?>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/css/404.css">
    </head>
    <div class="text">
        <div>ERROR</div>
        <h1>404</h1>
        <hr>
        <div>Page Not Found</div>
    </div>

    <div class="astronaut">
        <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src">
    </div><div class="text">
    <div>ERROR</div>
    <h1>404</h1>
    <hr>
    <div>Page Not Found</div>
</div>

    <div class="astronaut">
        <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src">
    </div>


    <script src="/js/404.js"></script>


<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
