<?php
include '../config/config.php';
include '../config/bdd.php';
if (loginverify()===false) {
    header('location:../login.php');
    die;
}
if (!pickRoles('admin')) {
    $_SESSION['non-autorise'] = true;
    header('location:'.URL.'pages/index.php');
    die;
}
include '../inc/top.php';

?>
    <title>Ajouter utilisateur</title>
<?php 
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
$roles=selectSql($bdd,'roles', '');
// var_dump($roles);
// var_dump($users);

?>


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ajouter un utilisateur</h1>
    <?php 
    superError("L'utilisateur ","ajouté");
    Error("error_upload","L'avatar","ajouté");
    
    ?>
    <form class="user" action="action.php" method="POST" enctype="multipart/form-data">
        <div class="form-group text-left">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control form-control-user" id="nom" name="nom" aria-describedby="nomHelp">
        </div>
        <div class="form-group text-left">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control form-control-user" id="prenom" name="prenom" aria-describedby="prenomlHelp">
        </div>
        <div class="upload text-left mb-3">
            <label for="avatar">Avatar :</label>
            <input class="browse "type="file" accept="image/png" class="d-block" id="avatar" name="avatar" aria-describedby="avatarlHelp">
        </div>
        <!-- <div class="upload text-left">
            <span class="d-block">Avatar :</span>
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Avatar :</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name ="avatar" id="avatar" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="avatar">Choisissez un fichier</label>
            </div>
        </div>   -->
        <div class="form-group text-left">
            <label for="role" class="d-block">Rôle(s) :</label>
            <select multiple class="multiple_select form-control" name="role[]" id="role">
                <option value=""></option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id']?>"><?= $role['libelle'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group text-left">
            <label for="mail">Mail :</label>
            <input type="email" class="form-control form-control-user" id="mail" name="mail" aria-describedby="emailHelp">
        </div>
        <div class="form-group text-left">
            <label for="mdp">Mot de passe :</label>
            <input type="password" class="form-control form-control-user" id="mdp" name="mdp" aria-describedby="passwordHelp">
        </div>
        <button type="submit" class="btn btn-dark" name="btn_add">Ajouter</button>
     </form>



<?php
include '../inc/footer.php';
include '../inc/bottom.php';
?>