<?php
ob_start();
?>
<h1><i class="fas fa-solid fa-user logoPage"></i>Identification</h1>
    <section class="formLogin">
        <h2>S'identifier</h2>
        <div class="separateur"></div>
        <form action="/login/" method="post">

            <div class="blockInput">
                <div class="labelInput">
                    <label for="pseudo"><i class="fas fa-user-tie"></i></label>
                    <input type="text" name="pseudo" value="<?php echo old("pseudo");?>" placeholder="pseudo">
                </div>
                <span class="error"><?php echo error("pseudo");?></span>
            </div>

            <div class="blockInput">
                <div class="labelInput">
                    <label for="password"><i class="fas fa-key"></i></label>
                    <input id="inputPassword" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="password">
                    <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
                </div>
                <span class="error"><?php echo error("password");?></span>
                <span class="error"><?php echo error("message");?></span>
            </div>

            <button type="submit" name="button">S'identifier</button>
        </form>
    </section>

    <script>
        var btnPass = document.getElementById("btnPassword");
        var inputPass = document.getElementById("inputPassword");
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