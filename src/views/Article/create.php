<?php
ob_start();
?>

<section class="create">
    <h1><i class="fas fa-plus logoPage"></i> Création d'un article :</h1>
    <form action="/dashboard/nouveau" method="post" enctype='multipart/form-data' class="list">
        <div class="top">
            <h2>Ajouter un article</h2>
        </div>
        <div class="separator"></div>
        <div class="bottom">
            <input type="text" name="name" value="<?php echo old("name");?>" placeholder="Titre de l'article" id="TitreArticle">
            <label for="TitreArticle"></label>
            <p> Photo: <input type="file" name="photo"></p>
            <textarea name="texte" id="" rows="5" cols="40" placeholder="Commentaire de l'article"><?php echo old("texte");?></textarea>
            <label for="CreateComment"></label>
            <br>
            <button id="postArticle">Poster l'article</button>
            <span class="error"><?php echo error("name");?><?php echo error("texte");?></span>
        </div>
    </form>
</section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
