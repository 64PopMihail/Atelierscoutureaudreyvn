<?php 
require '../admin/config/config.php'; 
require '../admin/config/bdd.php'; 
require '../include/head.php';
?>
<div class="log">
    <div class="signup_img" id="signUp">
    </div>
    <div class="log_card">
        <h1>Bienvenu(e) aux ateliers couture d'Audrey</h1>
        <div class="signIn">
            <form action="action.php" method="POST" class="formUser">
                <div class="formControl">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required minlength="2" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required minlength="3" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="email">Email :</label>
                    <input type="mail" name="email" id="email" required minlength="3" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" name="mdp" id="mdp" required minlength="6" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="mdp2">Confirmer le mot de passe :</label>
                    <input type="password" name="mdp2" id="mdp2" required minlength="6" autocomplete="off">
                </div>
                <div class="formControl">
                    <label for="avatar">Avatar :</label>
                    <input type="file" name="avatar" class="browse" id="AvatarUpload">
                </div>
                <span>Pas d'avatar? C'est par <a href="https://getavataaars.com/">ici</a>.</span>
                <input type="submit" name="btn_signUp" value="Créer mon compte" class="btnRed">
            </form>
        </div>
    </div>
</div>



<?php 
require '../include/bottom.php';
?>    
 