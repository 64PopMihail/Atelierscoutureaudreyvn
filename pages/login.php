<?php 
require '../admin/config/config.php'; 
require '../admin/config/bdd.php'; 
require '../include/head.php';
?>
<div class="log">
    <div class="log_img">
    </div>
    <div class="log_card">
        <div class="signUp">
            <span class="black">Pas encore inscrit(e)?</span>
            <a href="<?= URL ?>pages/signup.php"class ="btnRed">Je crée mon compte</a>
        </div>
        <div class="separator">
        </div>
        <div class="signIn">
            <form action="action.php" method="POST" class="formUser">
                <div class="formControl">
                    <label for="email">Email :</label>
                    <input type="mail" name="email" id="email" required minlength="3" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" required minlength="3" autocomplete="off">
                </div>
                <input type="submit" name="btn_login" id="login" value="Je me connecte" class="btnRed">
            </form>
        </div>
    </div>
</div>



<?php 
require '../include/bottom.php';
?>    
 