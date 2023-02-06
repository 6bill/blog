<?php
ob_start();
?>

    <section class="dashboard">

        <div class="blockAllList" id="masonry">
            <?php
            foreach ($articles as $article) {
                ?>
                <div class="blockCard">
                    <div class="card">
                        <div class="top">
                            <form action="/dashboard/doneModif" method="post">
                                <p><textarea name="Titre" id="" cols="20" rows="1"><?php echo escape($article->getTitre()); ?></textarea>
                                    (posté
                                    <?php
                                    $date = new DateTimeImmutable(escape($article->getDate()));
                                    echo $date->format('D d M Y');
                                    ?> par <?php echo escape($article->getPseudoUser()); ?> )</p>
                                <p>
                                    <input type="hidden" value="<?php echo escape($article->getId_article()); ?>" name="IDARTICLE">
                                    <button class="button btn-danger" type="submit">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Validé</span></button>
                        </div>
                        <div class="top">
                            <?php
                            if (!empty($article->getPhoto())) { ?>
                                <p><img src="image/<?php echo escape($article->getPhoto()); ?>" name="image"></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="modif">
                            <textarea name="Texte" id="" cols="80" rows="10" ><?php echo escape($article->getTexte());?></textarea>
                        </div>
                    </div>
                </div>
                </form>
                <?php
            }
            ?>
        </div>
    </section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
