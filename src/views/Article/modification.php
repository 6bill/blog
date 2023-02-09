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
                                <p><label for="titreModif"><textarea name="Titre" id="titreModif" cols="20" rows="1"><?php echo escape($article->getTitre()); ?></textarea></label>
                                    (posté
                                    <?php
                                    $date = new DateTimeImmutable(escape($article->getDate()));
                                    echo $date->format('D d M Y');
                                    ?> par <?php echo escape($article->getPseudoUser()); ?> )</p>
                                <p>
                                    <input type="hidden" value="<?php echo escape($article->getId_article()); ?>" name="idArticle">
                                    <button class="button btn-danger" type="submit">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Validé</span></button>
                        </div>
                        <div class="top">
                            <?php
                            if (!empty($article->getPhoto())) { ?>
                                <p><img src="image/<?php echo escape($article->getPhoto()); ?>" name="image" alt="imageArticle"></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="modif">
                            <label for="texteModif"><textarea name="Texte" id="texteModif" cols="80" rows="10" ><?php echo escape($article->getTexte());?></textarea></label>
                        </div>
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
