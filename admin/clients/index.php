<?php

include '../config/config.php';
include '../config/bdd.php';
// var_dump($_SESSION);
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
$title = 'Index clients';
include '../inc/top.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
$limit = 10;
$adresse =""; 
if (isset($_GET['limit'])) {
    $limit = intval($_GET['limit']) ;
    // var_dump($limit);
}
$adresse="limit=$limit";
// Je compte tous les clients
$sql="SELECT COUNT(*) FROM utilisateurs_roles 
INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
WHERE statut = 0 AND roles.id = 2";
$req= $bdd->prepare($sql);
$req->execute();
$count= $req->fetch(PDO::FETCH_ASSOC);
// 
// var_dump($count);
$nb_pages = intval(ceil($count['COUNT(*)']/$limit));
// var_dump($count['COUNT(*)']." / ".$limit." = ".$nb_pages);
// Je selectionne les clients par 10 pour les afficher
$sql="SELECT * FROM utilisateurs_roles 
INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
WHERE statut = 0 AND roles.id = 2 LIMIT $limit";
// var_dump($sql);
if (isset($_GET['off'])) {
    //Je selectionne les clients par 10 avec le décalage
    $sql= "SELECT * FROM utilisateurs_roles 
        INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
        INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
        WHERE statut = 0 AND roles.id = 2 LIMIT $limit OFFSET ".$_GET['off']."";
}
// var_dump($sql);
$req= $bdd->prepare($sql);
$req->execute();
$utilisateurs= $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);
?>
    <h1 class="h3 mb-3 text-gray-800">Liste des clients</h1>
    <?php
    superSuccess("update","Le client","mis à jour");
    superSuccess("delete","Le client","supprimé");
    ?>
    <a href="add.php" class="btn btn-dark mb-3">Ajouter</a>
    <div class="card shadow mb-4">
        <div class="dropdown mt-3">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Afficher par 
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index.php?limit=10">10</a>
                    <a class="dropdown-item" href="index.php?limit=25">25</a>
                    <a class="dropdown-item" href="index.php?limit=50">50</a>
                    <a class="dropdown-item" href="index.php?limit=100">100</a>
                    <a class="dropdown-item" href="index.php?limit=250">250</a>
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NOM</th>
                            <th>PRENOM</th>
                            <th>MAIL</th>
                            <th>AVATAR</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NOM</th>
                            <th>PRENOM</th>
                            <th>MAIL</th>
                            <th>AVATAR</th>
                            <th>ACTION</th>
                        </tr>
                    </tfoot>
                    <tbody>
                       <?php foreach ($utilisateurs as $utilisateur) { // J'affiche les clients dans un tableau ?>
                        <tr>
                            <td class="align-middle"><?= $utilisateur['nom']?></td>
                            <td class="align-middle"><?= $utilisateur['prenom']?></td>
                            <td class="align-middle"><?= $utilisateur['mail']?></td>
                            <td><img class="avatar" src="<?= URLADMIN?>img/avatars/<?= $utilisateur['avatar']?>" alt="avatar"></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="action.php?id=<?= $utilisateur['id']?>">Supprimer</a>
                                        <a class="dropdown-item" href="ficheutilisateur.php?id=<?= $utilisateur['id']?>">Fiche utilisateur</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <?php 
               if ($nb_pages>1){?>
                   <div class="pagination"> 
                       <span class=" text-dark mr-2">Pages : </span>             
                       <?php 
                       $page = 1;
                       $off = 0;
                       // J'utilise une boucle pour générer le bon nombre de pages en fonction de l'affichage
                       for ($i=0; $i < $nb_pages; $i++) {
                           if (isset($_GET['page']) && $_GET['page']==$page) {
                               $decoration = " border-bottom-dark";
                           }
                           else {
                               $decoration="";
                           }
                           ?>
                           <!--Je met toute les informations nécéssaires dans la balise HTML du lien  -->
                           <a class="mr-2 text-dark<?= $decoration; ?>" href="index.php?off=<?= $off.'&'.$adresse; ?>&page=<?= $page;?>"> <?= $page;?></a> 
                       <?php
                       $page = $page+1;
                       $off= $off+$limit;
                       }?>           
                   </div>
               <?php }?>  
            </div>
        </div>
    </div>

<!-- </div> -->
<!-- /.container-fluid -->

<?php
include '../inc/footer.php';
include '../inc/bottom.php';
?>

