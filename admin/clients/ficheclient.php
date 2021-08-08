<?php 
// session_start();
include '../config/config.php';
include '../config/bdd.php';
if (loginverify()===false) {
    header('location:../login.php');
    die;
}
if (!pickRoles('Super admin')) {
    $_SESSION['non-autorise'] = true;
    header('location:../index.php');
    die;
}
$title = "Fiche utilisateur";
include '../inc/top.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';


$utilisateur=select1sql($bdd,'utilisateurs','WHERE id='.$_GET['id'].'');
// var_dump($utilisateur);
$utilisateur_roles= selectSql($bdd,'utilisateurs_roles','INNER JOIN roles ON roles.id=utilisateurs_roles.id_role WHERE id_utilisateur='.$_GET['id'].'');
// var_dump($utilisateur_roles);

?>
<!-- Begin Page Content -->
<div class="container pt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Fiche utilisateur de<?php echo ' '.$utilisateur['prenom'].' '.$utilisateur['nom']?></h1>
    <div class="img_utilisateur mb-5">
        <img src="<?php echo '../avatars/'.$utilisateur['avatar']?>" alt="avatar utilisateur<?php echo ' '.$utilisateur['nom'].' '.$utilisateur['prenom']?>">
    </div>
    <?php 
    superError('L\'utilisateur','mis à jour');
    ?>
    <form class="user mb-5" action="action.php" method="POST">
        <input type="hidden" name="id" value="<?= ' '.$utilisateur['id']?>">
        <div class="form-group text-left">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control form-control-user" id="nom" name="nom" aria-describedby="nomHelp" value="<?= $utilisateur['nom']?>" readonly="readonly">
        </div>
        <div class="form-group text-left">
            <label for="prenom">Prénom :</label>
            <input type="text" class="form-control form-control-user" id="prenom" name="prenom" aria-describedby="prenomlHelp" value="<?= $utilisateur['prenom']?>" readonly="readonly">
        </div>
        <div class="form-group text-left">
            <label for="pseudo">Pseudonyme :</label>
            <input type="text" class="form-control form-control-user" id="pseudo" name="pseudo" aria-describedby="adresseHelp" value="<?= $utilisateur['pseudo']?>" readonly="readonly">
        </div>
        <div class="form-group text-left">
            <label for="mail">Mail :</label>
            <input type="mail" class="form-control form-control-user" id="mail" name="mail" aria-describedby="adresseHelp" value="<?= $utilisateur['mail']?>" readonly="readonly">
        </div>
        <div class="form-group text-left" id="select2">
            <label for="role" class="d-block">Rôle(s) :</label>
            <select multiple class="multiple_select form-control" name="role[]" id="role" readonly>
                <?php foreach ($utilisateur_roles as $role) : ?>
                <option value="<?= $role['id_role'] ?>" selected><?= $role['libelle'] ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <?php if ($_SESSION['utilisateur']['id']!=$_GET['id']) {?>
            <a class="btn btn-warning" href="update.php?id=<?= $utilisateur['id']?>">Modifier</a>
        <?php }?>
     </form>
</div>


<?php
include '../inc/footer.php';
include '../inc/bottom.php';
?>