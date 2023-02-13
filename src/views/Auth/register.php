<?php
ob_start();
?>
    <h1><i class="fas fa-solid fa-user logoPage"></i> Création d'un utilisateur :</h1>
<section id="sectionLogin">
    <h2>Inscription</h2>
  <form action="/register" method="post" id="formLogin">

    <div class="blockInput">
      <div class="labelInput">
        <label for="pseudo"><i class="fas fa-user-tie"></i></label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo old("pseudo");?>" placeholder="pseudo">
      </div>
      <span class="error"><?php echo error("pseudo");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="password"><i class="fas fa-key"></i></label>
        <input id="password" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="password">
        <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
      </div>
      <span class="error"><?php echo error("password");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="passwordConfirm"><i class="fas fa-key"></i></label>
        <input id="passwordConfirm" class="inputPassword" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirm password">
        <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
      </div>
      <span class="error"><?php echo error("passwordConfirm");?></span>
      <span class="error"><?php echo error("confirm");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="role"><i class="fas fa-user-tie"></i></label>
        <select name="role" id="role">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
      </div>
    </div>

    <button type="submit" name="button" id="submitLogin">Créer l'utilisateur</button>
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

var btnPassConf = document.getElementById("btnPasswordConfirm");
var inputPassConf = document.getElementById("inputPasswordConfirm");
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