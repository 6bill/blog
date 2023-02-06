<?php
ob_start();
?>
<head>
    <link rel="stylesheet" href="/css/login.css">
</head>
<form action="/login/" method="post">
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
                            <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
                        </div>
                        <span class="error"><?php echo error("password");?></span>
                        <span class="error"><?php echo error("message");?></span>
                    </div>
                    <button type="submit" class="btn mt-4" name="button">submit</button>
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
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
?>













