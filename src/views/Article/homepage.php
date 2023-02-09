<?php
ob_start();
?><html lang="fr">
    <body class="bg-planete">
        <section class="homepage">
        <h1>Bienvenue sur RealDream</h1>
        </section>
</body>
</html>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
