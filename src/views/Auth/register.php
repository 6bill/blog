<?php
ob_start();
?>
    <head>
        <link rel="stylesheet" href="/css/login.css">
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
                                    <input type="text" name="username" class="form-style" placeholder="Ton pseudo" id="username" value="<?php echo old("username");?>" autocomplete="on">
                                    <i class="input-icon uil uil-at"></i>
                                </div>

                                <div class="form-group mt-2">
                                    <input type="password" name="password" class="form-style" placeholder="Mots de passe" id="password" value="<?php echo old("password");?>" autocomplete="on">
                                    <i class="input-icon uil uil-lock-alt"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <input id="inputPasswordConfirm" class="form-style" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirm password">
                                </div>
                                <span class="error"><?php echo error("passwordConfirm");?></span>
                                <span class="error"><?php echo error("confirm");?></span>

                                <div class="blockInput">
                                    <div class="labelInput">
                                        <label for="role"><i class="fas fa-user-tie"></i></label>
                                        <select name="role">
                                            <?php
                                            $selected="";
                                            if (!empty(old("id_role"))) {
                                                $selected="selected";
                                            }
                                            echo "<option value='0'>Neutre</option>";
                                            echo "<option value='1'>Admin</option>";

                                            ?>
                                        </select>
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




    <script>
        let btnPass = document.getElementById("btnPassword");
        let inputPass = document.getElementById("inputPassword");
        btnPass.onclick = function() {
            if (inputPass.type === "password") {
                inputPass.type = "text";
            } else {
                inputPass.type = "password";
            }
        };

        let btnPassConf = document.getElementById("btnPasswordConfirm");
        let inputPassConf = document.getElementById("inputPasswordConfirm");
        btnPassConf.onclick = function() {
            if (inputPassConf.type === "password") {
                inputPassConf.type = "text";
            } else {
                inputPassConf.type = "password";
            }
        };
    </script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
?>