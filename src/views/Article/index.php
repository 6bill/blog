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
                        <?php
                        if (isset($_SESSION["user"])) {
                            ?>
                            <div class="separator"></div>
                            <article id="comment">
                                <h3>Poster un commentaire :</h3>
                                <div id="flexComment" postid="<?php echo $article->getId_article();?>">
                                    <label for="texteCommentaire<?php echo $article->getId_article();?>"></label>
                                    <input type="text" id="texteCommentaire<?php echo $article->getId_article();?>" placeholder="new comment" name="texte" required>
                                    <input type="hidden" id="IdArticleCommente" name="IdArticleCommente" value="<?php echo escape($article->getId_article()); ?>" required>
                                    <label for="imageComment"></label>
                                    <button type="submit" class="postCommentaire">Envoyer</button>
                                </div>
                            </article>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div id="divNouveauComment<?php echo $article->getId_article();?>">
                </div>
                <?php
                if (COUNT($article->getCommentaires()) > 0) {
                    foreach ($article->getCommentaires() as $commentaire) {
                        ?>
                        <div class='blockCard'>
                            <div class='cardComment'>
                                <div class='top'>
                                    <h3><?php echo escape($commentaire->getTitre()); ?></h3>
                                </div>
                                <div class='separator'></div>
                                <div class='top padding'>
                                    <p><?php echo escape($commentaire->getTexte()); ?>
                                </div>
                                <form action='/dashboard/<?php echo escape($commentaire->getId_article()); ?>/delete'
                                      method='post' id='formDeleteCommentaire'>
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        if ($_SESSION['user']['pseudo'] == escape($commentaire->getPseudoUser()) || $_SESSION['user']['role'] == 'admin') {
                                            ?>
                                            <div class='separator'></div>
                                            <button class='button btn-danger' type='submit' id='deleteCommentaire'
                                                    onclick='return confirm("Êtes-vous sur de vouloir supprimer ce métier ?")'>
                                                <img src='/image/trash.png' alt='trash' id='trash'>
                                            </button>
                                            <?php
                                        }
                                    }
                                    ?>
                                </form>
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