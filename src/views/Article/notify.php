<?php
ob_start();
?>

    <section class="dashboard">
        <h1><img src="../image/bell-black.png" alt="notify" class="logoPage">Notifications</h1>
        <div class="blockAllList" id="masonry">
            <?php
            foreach ($articles as $article) {
                ?>
                <div class="blockCard">
                    <div class="card">
                        <div class="top">
                            <p><?php echo escape($article->getTitre()); ?>
                                (posté
                                <?php
                                try {
                                    $date = new DateTimeImmutable(escape($article->getDate()));
                                } catch (Exception $e) {
                                }
                                echo $date->format('D d M Y');
                                ?> par <?php echo escape($article->getPseudoUser()); ?> )</p>
                        </div>
                        <div class="top">
                            <?php
                            if (!empty($article->getPhoto())) { ?>
                                <img src="../image/<?php echo escape($article->getPhoto()); ?>" alt="">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="top">
                            <p><?php echo escape($article->getTexte()); ?>
                        </div>
                        <form action="/dashboard/validation/" method="post" id="validation">
                            <input type="hidden" id="hidden" name="IdArticle" value="<?php echo escape($article->getId_article()); ?>" required>
                            <input type="submit" id="submit" value="Publier l'article">
                        </form>
                        <form action="/dashboard/<?php echo escape($article->getId_article()); ?>/delete" method="post" id="FormDelete">
                            <input type="hidden" id="hidden" name="IdArticle" value="<?php echo escape($article->getId_article()); ?>" required>
                            <input type="submit" id="submitDelete" value="Supprimer l'article">
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
