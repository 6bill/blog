<?php
ob_start();
?>

<section class="homepage">
    <article>
        <?php
        if (isset($_SESSION["user"])){
            echo "<h1 id='welcome'>Bienvenue " . $_SESSION["user"]["pseudo"]."</h1>";
        } else {
            echo "<h1 id='welcome'>Bienvenue</h1>";
        } ?>
        <h2>Dans le blog le plus simple du monde</h2>
    </article>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';