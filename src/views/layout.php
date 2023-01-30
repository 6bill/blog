<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>— Blog —</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <nav>
        <?php
        if (!isset($_SESSION["user"])) {
            echo '
        <a href="/" class="logo"><i class="fas fa-home"></i></a>
        <div class="hoverLink">
            <a href="/login" class="icon"><i class="fa-regular fa-door-open"></i></a>
            <p class="hidden">Login</p>
        </div>';
        }

        if (isset($_SESSION["user"])) {
            echo '
        <a href="/" class="logo"><i class="fas fa-home"></i></a>
        <div class="hoverLink">
            <a href="/logout" class="icon"><i class="far fa-door-open"></i></a>
                
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
            echo "<p>Bonjour a vous - </p>" . $_SESSION['user']['pseudo'];
        }
        ?>
        <div class="wrap">
            <div class="search">
                <input type="search" id="searchByWords" class="searchTerm" placeholder="Recherche un article">
             </div>
            <div class="resultByWords"></div>
        </div>

        <div class="wrap2">
            <div class="search">
                <input type="search" id="searchByPseudo" class="searchTerm" placeholder="Recherche une personne">
             </div>
            <div class="resultByPseudo"></div>
        </div>
    </nav>
</header>

<main>
    <?php echo $content;?>
</main>
<script src="https://kit.fontawesome.com/63e51d0dbe.js" crossorigin="anonymous"></script>
<script  src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/search.js"></script>

</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
