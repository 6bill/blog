<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>— Blog —</title>
    <script src="https://kit.fontawesome.com/c1d0ab37d6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="/" class="logo"><i class="fas fa-home"></i></a>
        <div class="hoverLink">
            <a href="/dashboard" class="icon"><i class="fas fa-list-alt"></i></a>
            <p class="hidden">Blog</p>
        </div>
        <div class="hoverLink">
            <a href="/dashboard/nouveau" class="icon"><i class="fas fa-plus"></i></a>
            <p class="hidden">New article</p>
        </div>
    </nav>
</header>

<main>
    <?php echo $content; ?>
</main>

</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
