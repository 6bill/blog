<?php
ob_start();
?>

    <section class="dashboard">
        <h1><i class="fas fa-list-alt logoPage"></i> Liste des articles :</h1>
        <div class="blockAllList" id="masonry">
            <?php
            if(ISSET($_SESSION["erreur"])){?>
                <p id="error"><?php echo $_SESSION["erreur"]; ?> </p>
                <?php
            }
            else if(ISSET($_SESSION["like"])){ ?>
                <p id="like"><?php echo $_SESSION["like"]; ?></p>
            <?php }
            foreach ($articles as $article) {
                ?>
                <div class="blockCard">
                    <div class="card">
                        <div class="top">
                            <h2 id="titreArticle"><?php echo escape($article->getTitre()); ?>
                                <br> Posté
                                <?php
                                try {
                                    $date = new DateTimeImmutable(escape($article->getDate()));
                                } catch (Exception $e) {
                                }
                                echo $date->format('D d M Y');
                                ?> par <?php echo escape($article->getPseudoUser()); ?></h2>

                            <a href="/article/<?php echo escape($article->getId_article()); ?>/modify">
                                <?php
                                if (isset($_SESSION["user"])) {
                                    if ($_SESSION["user"]["pseudo"] == escape($article->getPseudoUser())) {?>
                                        <button class="button btn-danger" type="submit" id="edit">
                                            <img src="/image/edit.png" alt="" id="imgEdit">
                                            <span>Modifier</span>
                                        </button>
                                        <?php
                                    }
                                }
                                ?>
                            </a>
                       </div>
                        <div class="separator"></div>
                        <article id="photoLike">
                            <div class="top">
                                <?php
                                if (!empty($article->getPhoto())) { ?>
                                    <img src="/image/<?php echo escape($article->getPhoto()); ?>" alt="">
                                    <?php
                                }
                                ?>
                            </div>
                            <form action="/dashboard/<?php echo escape($article->getId_article()); ?>/like" method="post" id="formLike">
                                <?php
                                if (isset($_SESSION["user"])) {
                                    ?>
                                        <input type="hidden" name="Id_article" value="<?php echo escape($article->getId_article()); ?>">
                                        <button class="heart"></button>
                                    <?php
                                }
                                ?>
                            </form>
                        </article>
                        <form action="/dashboard/<?php echo escape($article->getId_article()); ?>/delete"
                              method="post">
                            <?php
                            if (isset($_SESSION["user"])) {
                                if ($_SESSION["user"]["pseudo"] == escape($article->getPseudoUser()) || $_SESSION["user"]["role"] == 'admin') {?>
                                    <button class="button btn-danger" type="submit" id="delete"
                                            onclick="return confirm('Êtes-vous sur de vouloir supprimer ce métier ?')">
                                        <img src="/image/trash.png" alt="trash" id="trash">
                                    </button>
                                    <?php
                                }
                            }
                            ?>
                        </form>
                        <div class="top">
                            <p id="texteArticle"><?php echo escape($article->getTexte()); ?>
                        </div>
                        <div class="separator"></div>
                        <?php
                        if (isset($_SESSION["user"])) {
                            ?>
                            <article id="comment">
                                <h3>Poster un commentaire :</h3>
                                <div id="flexComment">
                                    <label for="texteCommentaire"></label>
                                    <input type="text" id="texteCommentaire" placeholder="new comment" name="texte"
                                           required>
                                    <input type="hidden" id="IdArticleCommente" name="IdArticleCommente"
                                           value="<?php echo escape($article->getId_article()); ?>" required>
                                    <label for="imageComment"></label>
                                    <button type="submit" id="postCommentaire">Envoyer</button>
                                </div>
                            </article>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                if (COUNT($article->getCommentaires()) > 0) {
                    foreach ($article->getCommentaires() as $commentaire) {
                        ?>
                        <div class="blockCard">
                            <div class="cardComment">
                                <div id="divCommentaires">
                                </div>

                                <div class="top">
                                    <p><?php echo escape($commentaire->getTitre()); ?></p>
                                    <hr>
                                    <p>
                                    <form action="/dashboard/<?php echo escape($commentaire->getId_article()); ?>/delete"
                                          method="post">
                                        <?php
                                        if (isset($_SESSION["user"])) {
                                            if ($_SESSION["user"]["pseudo"] == escape($commentaire->getPseudoUser()) || $_SESSION["user"]["role"] == 'admin') {
                                                ?>
                                                <button class="button btn-danger" type="submit"
                                                        onclick="return confirm('Êtes-vous sur de vouloir supprimer ce métier ?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                         width="16"
                                                         height="16"
                                                         fill="currentColor">
                                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                                                    </svg>
                                                    <span>Delete</span></button>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </form>
                                </div>

                                <div class="top padding">
                                    <p><?php echo escape($commentaire->getTexte()); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
            }
            ?>
        </div>
    </section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';