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
            <a href="/dashboard" class="icon"><i class="fas fa-list-alt"></i>
            <p class="hidden">Blog</p></a>
        </div>
        <?php
            if (isset($_SESSION["user"])) {
                echo '<div class="hoverLink">
                    <a href="/dashboard/nouveau" class="icon"><i class="fas fa-plus"></i>
                    <p class="hidden">New article</p></a>
                </div>';
                if ($_SESSION["user"]["role"] == "admin") {
                    echo '<div class="hoverLink">
                    <a href="/register/" class="icon"><i class="fas fa-solid fa-user"></i>
                    <p class="hidden">Créer un utilisateur</p></a>
                </div>
                <div class="hoverLink">
                    <a href="/notify/" class="icon"><img src="../image/bell.png" alt="notify" id="bell">
                    <p class="hidden">Notifications</p></a>
                </div>';
                }
                echo '<form action="/logout/" method="post">
                    <button type="submit" id="logout" class="hoverLink">
                        <a href="/" class="icon" type="submit">
                            <img src="../image/logout.png" alt="logout">
                        </a>
                        <p class="hidden">Logout</p>
                    </button>
                   </form>';

                echo "<h2 id='welcome'>Bienvenue" ." ". $_SESSION["user"]["pseudo"]."</h2>";
            } else {
                echo ' <div class="hoverLink"><a href="/login/" class="icon"><i class="fas fa-solid fa-user"></i>
                   <p class="hidden">Login</p></a></div>';
            }
        ?>
        <div id="search">
            <div class="searchPseudo">
                <label for="searchByWordsPseudo"></label>
                <input type="search" class="searchTerm" id="searchByWordsPseudo" placeholder="Cherchez un utilisateur">
            </div>
            <div class="resultByWordsPseudo">
            </div>
            <div class="searchArticle">
                <label for="searchByWordsArticle"></label>
                <input type="search" class="searchTerm" id="searchByWordsArticle" placeholder="Cherchez un article">
            </div>
            <div class="resultByWordsArticle">
            </div>
        </div>
    </nav>
</header>

<main>
    <?php echo $content; ?>
</main>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="../js/search.js"></script>
</body>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
