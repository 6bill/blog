<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>— RealDream —</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/gif" href="/image/platene-logo.gif"/>
</head>
<body>
<header>
    <nav>
        <?php
        if (!isset($_SESSION["user"])) {
            echo '
        <a href="/" class="logo"><i class="fas fa-home"></i></a>
        <div class="hoverLink">
            <a href="/login" class="icon"><i class="fa-solid fa-door-closed"></i></a>
            <p class="hidden">Login</p>
        </div>';
        }

        if (isset($_SESSION["user"])) {
            echo '
        <a href="/" class="logo"><i class="fas fa-home"></i></a>
        <div class="hoverLink">
            <a href="/logout" class="icon"><i class="fa-solid fa-door-open"></i></a>
            <p class="hidden">Logout</p>
        </div>';
        }
        ?>
<?php
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["role"] == 1) {
            echo '
        <div class="hoverLink">
            <a href="/register" class="icon"><i class="fa-solid fa-plus"></i></a>
            <p class="hidden">register</p>
        </div>
        ';
    }
        }
        ?>

        <?php
        if (isset($_SESSION["user"])) {
            if ($_SESSION["user"]["role"] == 1) {
                echo '
        <div class="hoverLink">
            <a href="/verify" class="icon"><i class="fa-solid fa-bell"></i></a>
            <p class="hidden">verify</p>
        </div>
        ';
            }
        }
        ?>

        <div class="hoverLink">
            <a href="/dashboard" class="icon"><i class="fas fa-list-alt"></i></a>
            <p class="hidden">Blog</p>
        </div>
        <?php
        if (isset($_SESSION["user"])) {
            echo "
            <div class='hoverLink'>
            <a href = '/dashboard/nouveau' class='icon' ><i class='fa-solid fa-pen'></i></a>
            <p class='hidden'> new article</p >
        </div >";
            echo "<p>Bonjour a vous " . $_SESSION['user']['pseudo'] . "</p>";
        }
        ?>
        <div id="recherche">
        <div class="wrap">
            <div class="search">
                <label for="searchByWords"><input type="search" id="searchByWords" class="searchTerm" placeholder="Recherche un article"></label>
             </div>
            <div class="resultByWords"></div>
        </div>

        <div class="wrap">
            <div class="search">
                <label for="searchByPseudo"><input type="search" id="searchByPseudo" class="searchTerm" placeholder="Recherche une personne"></label>
             </div>
            <div class="resultByPseudo"></div>
        </div>
        </div>
    </nav>
</header>

<main>
    <?php echo $content;?>
</main>
<script src="https://kit.fontawesome.com/63e51d0dbe.js" crossorigin="anonymous"></script>
<script  src="../js/jquery.js"></script>
<script  src="/js/commentaire.js"></script>
<script type="text/javascript" src="../js/search.js"></script>

</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
