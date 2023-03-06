<?php
ob_start();
?>
    <section class="create">
        <h1><img src="../image/edit.png" class="logoPage" alt=""> Modification d'un article :</h1>
        <div>
            <div class="list">
                <div class="top">
                    <p>Modifier un article</p>
                </div>
                <div class="separator"></div>
                <div class="bottom">
                    <form action="/dashboard/update" method="post">
                        <input type="text" name="titre" value="<?php echo $article->getTitre()?>" placeholder="Titre de l'article">
                        <input type="hidden" name="IdArticle" value="<?php echo $article->getId_article();?>">
                        <p>
                            Photo: <input type="file" name="photo" value="<?php echo $article->getPhoto();?>">
                        </p>
                        <textarea name="texte" rows="8" cols="40" placeholder="texte de l'article"><?php echo $article->getTexte();?></textarea>
                        <br>
                        <p align="right"><button  type="submit" id="postArticle">Mettre à jour l'article</button></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
