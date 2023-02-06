<?php

use Blog\models\User;
use Blog\models\UserManager;
ob_start();
?>

<head>
    <link rel="stylesheet" href="/css/login.css">
</head>

<form action="/dashboard/nouveau" method="post" enctype='multipart/form-data'>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Crée un article</h4>
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-style" placeholder="Titre de l'article">
                                            </div>
                                            <div class="form-group mt-2">
                                                <textarea class="form-style" name="texte" rows="8" cols="40" placeholder="Texte de l'article"><?php echo old("texte");?></textarea>
                                            </div>
                                            <button class="btn mt-4">Poster l'article</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<span class="error"><?php echo error("name");?><?php echo error("texte");?></span>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>

