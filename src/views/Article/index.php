<?php
ob_start();
?>

    <section class="dashboard">
        <div class="blockAllList" id="masonry">
            <div id="Titre">
                <div class="effetneon">
                    <span>RealDream</span>
                </div>
                <img src="/image/saturne.png" alt="">
            </div>
            <?php
            foreach ($articles as $article) {
                ?>
                <div class="blockCard">
                    <div class="card">
                        <div class="top">
                            <p><?php echo escape($article->getTitre()); ?>
                                (posté
                                <?php
                                $date = new DateTimeImmutable(escape($article->getDate()));
                                echo $date->format('D d M Y');
                                ?> par <?php echo escape($article->getPseudoUser()); ?> )</p>
                            <p>
                                <?php if (!$article->getLike() ){ ?>
                                <?php
                                if (isset($_SESSION["user"])){?>
                            <form action="/dashboard/<?php echo escape($article->getId_article());?>/like/" method="post">

                                <input type="hidden" name="IDARTICLE" value="<?php echo escape($article->getId_article()); ?>">

                                    <button class="like"><i class="fa-regular fa-heart"></i></button>
                                    <?php
                                }
                                ?>
                            </form>
                            <?php }else{ ?>
                            <?php
                            if (isset($_SESSION["user"])){?>
                            <form action="/dashboard/<?php echo escape($article->getId_article());?>/unLike/" method="post">

                                <input type="hidden" name="IDARTICLE" value="<?php echo escape($article->getId_article()); ?>">


                                    <button class="like"><i class="fa-solid fa-heart"></i></button>
                                    <?php
                                }
                                }
                                ?>

                            </form>

                            <form action="/dashboard/<?php echo escape($article->getId_article()); ?>/delete" method="post">
                                <?php
                                if (isset($_SESSION["user"])) {?>
                                <?php if ($_SESSION["user"]["pseudo"] == escape($article->getPseudoUser()) || $_SESSION["user"]["role"] == 1) {?>
                                    <button class="button btn-danger" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16" fill="currentColor">
                                            <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                                        </svg>
                                        <span>Delete</span></button>
                                    <?php
                                }
                                ?>
                            </form>

                            <form action="/dashboard/modification/" method="post">
                                <input type="hidden" name="IDARTICLE" value="<?php echo escape($article->getId_article()); ?>">
                                <?php
                                if ($_SESSION["user"]["pseudo"] == escape($article->getPseudoUser())) {?>
                                    <button class="button btn-danger" type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Modifier</span></button>
                                    <?php
                                }
                                }
                                ?>

                            </form>

                            </p>
                        </div>
                        <div class="top">
                            <?php
                            if (!empty($article->getPhoto())) { ?>
                                <p><img src="image/<?php echo escape($article->getPhoto()); ?>"></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="top">
                            <p><?php echo escape($article->getTexte()); ?>
                        </div>
                        <?php if (isset($_SESSION["user"])) { ?>
                            <input type="hidden" value="<?php echo escape($article->getId_article()); ?>" id="IdArticleCommente">
                            <textarea name="texte" rows="2" cols="40" placeholder="Commentaire de l'article" id="texteCommentaire"><?php echo old("texte");?></textarea>
                            <br>
                            <p align="right" class="postCommentaire"><button>Poster le commentaire</button></p>
                            <?php
                        }
                        ?>
                    </div>
                </div>


                <?php
                if (COUNT($article->getCommentaires()) > 0) {
                    foreach ($article->getCommentaires() as $commentaire) {
                        ?>
                        <div id="divcommentaires"></div>
                        <div class="blockCard">
                                   <div class="cardComment">

                                <div class="top">
                                    <?php echo escape($commentaire->getTitre()); ?>
                                    (posté
                                    <?php
                                    $date = new DateTimeImmutable(escape($commentaire->getDate()));
                                    echo $date->format('D d M Y');
                                    ?> par <?php echo escape($commentaire->getPseudoUser()); ?> )

                                    <form action="/dashboard/<?php echo escape($commentaire->getId_article()); ?>/delete"
                                          method="post">
                                        <?php
                                        if (isset($_SESSION["user"])) {
                                            if ($_SESSION["user"]["pseudo"] == escape($commentaire->getPseudoUser()) || $_SESSION["user"]["role"] == 1) {?>
                                                <button class="button btn-danger" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16" height="16" fill="currentColor">
                                                        <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/>
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </form>
                                </div>

                                <div class="top">
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
    <script  src="/js/commentaire.js"></script>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
