<?php
ob_start();
?>

<section class="formRegister">
  <h1>S'inscrire</h1>
  <div class="separateur"></div>
  <form action="/register/" method="post">

    <div class="blockInput">
      <div class="labelInput">
        <label for="username"><i class="fas fa-user-tie"></i></label>
        <input type="text" name="username" value="<?php echo old("username");?>" placeholder="login">
      </div>
      <span class="error"><?php echo error("username");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="password"><i class="fas fa-key"></i></label>
        <input id="inputPassword" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="password">
        <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
      </div>
      <span class="error"><?php echo error("password");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="passwordConfirm"><i class="fas fa-key"></i></label>
        <input id="inputPasswordConfirm" class="inputPassword" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirm password">
        <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
      </div>
      <span class="error"><?php echo error("passwordConfirm");?></span>
      <span class="error"><?php echo error("confirm");?></span>
    </div>

    <div class="blockInput">
      <div class="labelInput">
        <label for="role"><i class="fas fa-user-tie"></i></label>
        <select name="role">
        <?php
        
            foreach ($roles as $role) {
              $selected="";
              if (!empty(old("id_role"))) {
                $selected="selected";
              }
              echo "<option ".$selected." value='".$role->getId_role()."'>".escape($role->getLibelle_role())."</option>";
            } 
          ?>
        </select>
      </div>
    </div>

    <button type="submit" name="button">S'inscrire</button>
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
