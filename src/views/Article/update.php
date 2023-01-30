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
                        <input type="text" name="titre" value="<?php echo old("name");?>" placeholder="Titre de l'article">
                        <input type="hidden" name="idArticle" value="<?php echo old("name");?>">
                        <p>
                            Photo: <input type="file" name="photo">
                        </p>
                        <textarea name="texte" rows="8" cols="40" placeholder="Commentaire de l'article"><?php echo old("texte");?></textarea>
                        <br>
                        <p align="right"><button>Poster l'article</button></p>
                    </form>
                    <span class="error"><?php echo error("name");?><?php echo error("texte");?></span>
                </div>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
