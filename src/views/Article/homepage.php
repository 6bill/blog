<?php
ob_start();
?>
<body class="bg-planete">
<section class="homepage">
    <h1>Bienvenue sur RealDream</h1>
</section>
</body>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
