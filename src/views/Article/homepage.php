<?php
ob_start();
?>

<section class="homepage">
    <h1>Bienvenue sur le Blog
        <br>PHPGeek</br></h1>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
