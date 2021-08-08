<?php
include '../config/bdd.php';
include '../config/config.php';

if (loginVerify()===false) {
    header('location:login.php');
    die;
}
if (!pickRoles('admin')) {
    $_SESSION['non-autorise'] = true;
    header('location:'.URL.'pages/index.php');
    // var_dump(pickRoles('admin'));
    die;
}
$title = 'Mettre à jour la fiche client';
$utilisateurs=select1Sql($bdd,'utilisateurs','WHERE id='.$_GET['id']);

include '../inc/top.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';

// // var_dump($roles);
// var_dump($utilisateurs);


?>

   
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Mettre à jour le client <?=$utilisateurs['prenom'].' '.$utilisateurs['nom']?></h1>
        <?php 
        superError("Le client ","ajouté");
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
                <label for="avatar">Avatar :</label>
                <input type="text" class="form-control form-control-user" name="current_avatar" aria-describedby="pseudolHelp" readonly value="<?= $utilisateurs['avatar']?>">
            </div>
            <div class="upload text-left mb-3">
                <label for="avatar">Avatar :</label>
                <input class="browse "type="file" accept="image/png" class="d-block" id="avatar" name="avatar" aria-describedby="avatarlHelp">
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
