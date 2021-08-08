<?php
include '../config/bdd.php';
include '../config/config.php';

if (loginverify()===false) {
    header('location:../login.php');
    die;
}
if (!pickRoles('admin')) {
    $_SESSION['non-autorise'] = true;
    header('location:'.URL.'pages/index.php');
    die;
}
if ($_SESSION['utilisateur']['id']===$_GET['id']) {
    $_SESSION['modification-non-autorisee'] = true;
    header('location:../index.php');
    die;
}
include '../inc/top.php';
?>
    <title>Ajouter utilisateur</title>
<?php 
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
$utilisateurs=select1Sql($bdd,'utilisateurs','WHERE id='.$_GET['id']);
$roles=selectSql($bdd,'roles', 'WHERE statut=0');
// // var_dump($roles);
// var_dump($utilisateurs);
// var_dump($_SESSION['utilisateur']);

$utilisateur_roles= selectSql($bdd,'utilisateurs_roles','INNER JOIN roles ON roles.id=utilisateurs_roles.id_role WHERE id_utilisateur='.$_GET['id'].'');
// var_dump($utilisateur_roles);
foreach ($utilisateur_roles as $key) {
    $id_utilisateur_role[]=$key['id_role'];
}


?>

   
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Mettre à jour l'utilisateur</h1>
        <?php 
        superError("L'utilisateur ","ajouté");
        Error("error_upload","L'avatar","ajouté");
        ?>
        <form class="user" action="action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $utilisateurs['id']?>">
            <div class="form-group text-left">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control form-control-user" id="nom" name="nom" aria-describedby="nomHelp" value="<?= $utilisateurs['nom']?>">
            </div>
            <div class="form-group text-left">
                <label for="prenom">Prenom :</label>
                <input type="text" class="form-control form-control-user" id="prenom" name="prenom" aria-describedby="prenomlHelp" value="<?= $utilisateurs['prenom']?>">
            </div>
            <div class="form-group text-left">
                <label for="pseudo">Pseudonyme :</label>
                <input type="text" class="form-control form-control-user" id="pseudo" name="pseudo" aria-describedby="pseudolHelp" value="<?= $utilisateurs['pseudo']?>">
            </div>
            <div class="form-group text-left">
                <label for="avatar">Avatar :</label>
                <input type="text" class="form-control form-control-user" name="" aria-describedby="pseudolHelp" readonly value="<?= $utilisateurs['avatar']?>">
            </div>
            <div class="upload text-left mb-3">
                <label for="avatar">Avatar :</label>
                <input class="browse "type="file" accept="image/png" class="d-block" id="avatar" name="avatar" aria-describedby="avatarlHelp">
            </div>
        
            <div class="form-group text-left">
                <label for="role" class="d-block">Rôle(s) :</label>
                <select multiple class="multiple_select form-control" name="role[]" id="role">
                    <option value=""></option>
                    <?php foreach ($roles as $role): 
                        if (in_array($role['id'],$id_utilisateur_role)) {
                            $selected="selected";
                        } else {
                            $selected="";
                        } ?>
                        <option <?= $selected ?> value="<?= $role['id']?>"><?= $role['libelle'] ?></option>
                    <?php 
                    endforeach ; ?>
                </select>
            </div>
            <div class="form-group text-left">
                <label for="mail">Mail :</label>
                <input type="email" class="form-control form-control-user" id="mail" name="mail" aria-describedby="emailHelp" value="<?= $utilisateurs['mail']?>">
            </div>
            <button type="submit" class="btn btn-dark mb-5" name="btn_update">Modifier</button>
        </form>
    </div>


<?php
include '../inc/footer.php';
include '../inc/bottom.php';
