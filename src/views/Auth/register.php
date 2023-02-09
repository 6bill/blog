<?php
ob_start();
?>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="/css/login.css">
        <title>Register</title>
    </head>
    <form action="/register/" method="post">

        <div class="section">
            <div class="container">
                <div class="card-3d-wrap mx-auto">
                    <div class="card-3d-wrapper">
                        <div class="card-front">
                            <div class="center-wrap">
                                <h4 class="mb-4 pb-3">Log In</h4>
                                <div class="form-group">
                                    <label for="username"><input type="text" name="username" class="form-style" placeholder="Ton pseudo" id="username" value="<?php echo old("username");?>" autocomplete="on"></label>
                                    <i class="input-icon uil uil-at"></i>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="password"><input type="password" name="password" class="form-style" placeholder="Mots de passe" id="password" value="<?php echo old("password");?>" autocomplete="on"></label>
                                    <i class="input-icon uil uil-lock-alt"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="inputPasswordConfirm"><input id="inputPasswordConfirm" class="form-style" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirm password"></label>
                                </div>
                                <span class="error"><?php echo error("passwordConfirm");?></span>
                                <span class="error"><?php echo error("confirm");?></span>

                                <div class="blockInput">
                                    <div class="labelInput">
                                        <label for="role"><i class="fas fa-user-tie"></i></label>

                                        <label for="roleUser">
                                            <select name="role" id="roleUser">
                                                <?php
                                                $selected="";
                                                if (!empty(old("id_role"))) {
                                                    $selected="selected";
                                                }
                                                echo "<option value='0'>Neutre</option>";
                                                echo "<option value='1'>Admin</option>";

                                                ?>
                                            </select>
                                        </label>

                                    </div>
                                    <button type="submit" class="btn mt-4" name="button">S'inscrire</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="/js/seePassword.js"></script>
</html>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
?>