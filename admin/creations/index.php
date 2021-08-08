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
$title = 'Liste des créations';
include '../inc/top.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
$limit = 10;
$adresse = "";
if (isset($_GET['limit'])) {
    // var_dump($_GET['limit']);
    $limit = $_GET['limit'];
    // var_dump($limit);
    $adresse="limit=$limit";
}
// Je calcule le nombre de page en fonction du nombres d'occurences de la bdd à afficher
$sql="SELECT COUNT(*) FROM ateliers_creations 
INNER JOIN ateliers ON ateliers.id=ateliers_creations.id_ateliers
INNER JOIN creations ON creations.id=ateliers_creations.id_creations
WHERE ateliers.statut = 0";
$req= $bdd->prepare($sql);
$req->execute();
$count= $req->fetch(PDO::FETCH_ASSOC);
$nb_pages = intval(ceil($count['COUNT(*)']/$limit));
// var_dump($nb_pages);

// 10 occurences à afficher par défaut
$sql="SELECT * FROM ateliers_creations 
INNER JOIN ateliers ON ateliers.id=ateliers_creations.id_ateliers
INNER JOIN creations ON creations.id=ateliers_creations.id_creations
WHERE ateliers.statut = 0 LIMIT $limit";
// var_dump($sql);
if (isset($_GET['off'])) {
    $sql= "SELECT * FROM ateliers_creations 
    INNER JOIN ateliers ON ateliers.id=ateliers_creations.id_ateliers
    INNER JOIN creations ON creations.id=ateliers_creations.id_creations
    WHERE ateliers.statut = 0 
    ORDER BY date_atelier DESC
    LIMIT $limit OFFSET ".$_GET['off']."";
}

// var_dump($sql);
$req= $bdd->prepare($sql);
$req->execute();
$creations= $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($creations);
?>
    <h1 class="h3 mb-3 text-gray-800">Liste des creations</h1>
    <?php
    superSuccess("update","La création","mise à jour");
    superSuccess("add","La création","ajoutée");
    superSuccess("delete","La création","supprimée");
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
                            <th>DATE ATELIER</th>
                            <th>CREATION</th>
                            <!-- <th>RÔLE(S)</th> -->
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>DATE ATELIER</th>
                            <th>CREATION</th>
                            <!-- <th>RÔLE(S)</th> -->
                            <th>ACTION</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($creations as $creation) { ?>
                        <tr>
                            <td class="align-middle"><?= formatDate($creation['date_atelier'])?></td>
                            <td class="align-middle"><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal<?= $creation['id']?>">Aperçu</button>
                                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $creation['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                    <div class="modal-header text-center">
                                    <h5 class="modal-title " id="exampleModalLabel"><?= $creation['legende']?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                        <img src="<?= URLADMIN.'img/img_creations/'.formatDateFichierDirection($creation['date_atelier']).'/'.$creation['photo']?>" class="image" alt="miniature creation">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                                    </div>
                                    </div>
                                </div>
                                </div></td>
                            
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="update.php?id=<?= $creation['id']?>">Modifier</a>
                                        <a class="dropdown-item" href="action.php?id=<?= $creation['id']?>">Supprimer</a>
                                        <a class="dropdown-item" href="fichecreation.php?id=<?= $creation['id']?>">Fiche creation</a>
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
