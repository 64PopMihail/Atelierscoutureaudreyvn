<?php 
include 'config/config.php';
// var_dump(loginVerify());
if (loginVerify()===false) {
    header('location:login.php');
    die;
}
if (!pickRoles('admin')) {
    $_SESSION['non-autorise'] = true;
    header('location:'.URL.'pages/index.php');
    var_dump(pickRoles('admin'));
    die;
}
// var_dump($_SESSION);
$title = 'Accueil Back-Office';
include 'inc/top.php';
include 'inc/wrapper-sidebar.php';
include 'inc/content-wrapper-nav.php';
// var_dump($_SESSION);
var_dump($_SESSION['utilisateur']);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Accueil</h1>
    <?php 
    if (isset($_SESSION['non-autorise'])) {
        superAlert('danger',"Vous n'avez pas l'acréditation.");
        unset($_SESSION['non-autorise']);
    }
    if (isset($_SESSION['modification-non-autorisee'])) {
        superAlert('danger',"Vous n'avez pas le droit de modifier votre fiche utilisateur.");
        unset($_SESSION['modification-non-autorisee']);
    }
    ?>
    

</div>
<!-- /.container-fluid -->

<?php
include 'inc/footer.php';
include 'inc/bottom.php';
?>
