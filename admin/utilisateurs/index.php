<?php
// session_start(); 
// var_dump($_SESSION);
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
$title = 'Index utilisateurs';
include '../inc/top.php';


// include 'include/link-css.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
// var_dump($bdd);
// Je règle l'affichage d'enregistrements par défaut à 10.
$limit = 10;
$adresse = "";
if (isset($_GET['limit'])) {
    // Si un paramètre "limit" se retrouve dans l'URL cette valeur là va remplacer la valeur par défaut qui est 10.
    $limit = $_GET['limit'];
    
}
$adresse="limit=$limit";
// COUNT(*) Fonction qui permet de compter le nom d'enregistrement dans une table
$sql="SELECT COUNT(*) FROM utilisateurs_roles 
INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
WHERE statut = 0 AND roles.id = 1";
$req= $bdd->prepare($sql);
$req->execute();
$count= $req->fetch(PDO::FETCH_ASSOC);
// Cette fonction retourne un tableau avec une valeur exprimée en string  
// var_dump($count);
// Je transforme la valeur du tableau en int & la divise par la limite de d'enregistrement que je souhaite voir
// J'arrondis par excès le resultat de la division avec la fonction ceil() pour générer le bon nombre de pages
$nb_pages = intval(ceil($count['COUNT(*)']/$limit));
// var_dump($nb_pages);

$sql= "SELECT * FROM utilisateurs_roles 
INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
WHERE statut = 0 AND roles.id = 1 LIMIT $limit";
// var_dump($sql);
if (isset($_GET['off'])) {
    // $utilisateurs=selectSql($bdd,'utilisateurs', 'WHERE statut=0 LIMIT '.$limit.' OFFSET '.$_GET['off'].'');
    $sql= "SELECT * FROM utilisateurs_roles 
    INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles
    INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs
    WHERE statut = 0 AND roles.id = 1 LIMIT $limit OFFSET ".$_GET['off']."";
}

// var_dump($sql);
$req= $bdd->prepare($sql);
$req->execute();
$utilisateurs= $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($utilisateurs);
?>
    <h1 class="h3 mb-3 text-gray-800">Liste des utilisateurs</h1>
    <?php
    superSuccess("update","L'utilisateur","mis à jour");
    superSuccess("add","L'utilisateur","ajouté");
    superSuccess("delete","L'utilisateur","supprimé");
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
                            <!-- <th>RÔLE(S)</th> -->
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NOM</th>
                            <th>PRENOM</th>
                            <th>MAIL</th>
                            <th>AVATAR</th>
                            <!-- <th>RÔLE(S)</th> -->
                            <th>ACTION</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($utilisateurs as $utilisateur) { ?>
                        <tr>
                            <td class="align-middle"><?= $utilisateur['nom']?></td>
                            <td class="align-middle"><?= $utilisateur['prenom']?></td>
                            <td class="align-middle"><?= $utilisateur['mail']?></td>
                            <td><img class="avatar" src="<?= URLADMIN?>img/avatars/<?= $utilisateur['avatar']?>" alt="avatar"></td>
                            <!-- <td>roles</td> -->
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="update.php?id=<?= $utilisateur['id']?>">Modifier</a>
                                        <a class="dropdown-item" href="action.php?id=<?= $utilisateur['id']?>">Supprimer</a>
                                        <a class="dropdown-item" href="ficheutilisateur.php?id=<?= $utilisateur['id']?>">Fiche utilisateur</a>
                                    </div>
                                </div>
                            </td>
                            <!-- <td><a href="update.php?id=<? $utilisateur['id']?>" class="btn btn-warning">Modifier</a></td>
                            <td><a href="action.php?id=<? $utilisateur['id']?>" class="btn btn-danger">Supprimer</a></td> -->
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
                       for ($i=0; $i < $nb_pages; $i++) {
                            
                           if (isset($_GET['page']) && $_GET['page']==$page) {
                               $decoration = " border-bottom-danger";
                           }
                           else {
                               $decoration="";
                           }
                           ?>
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

