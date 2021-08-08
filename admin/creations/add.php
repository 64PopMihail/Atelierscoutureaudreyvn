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
$title = 'Ajouter des créations';
include '../inc/top.php';
include '../inc/wrapper-sidebar.php';
include '../inc/content-wrapper-nav.php';
$sql = 'SELECT id, date_atelier FROM ateliers WHERE date_atelier < NOW() ORDER BY date_atelier DESC';
$req = $bdd->prepare($sql);
$req -> execute();
$ateliers = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($ateliers);
?>
    <h1 class="h3 mb-4 text-gray-800">Ajouter une création</h1>
    <?php 
    superError();
    ?>
    <form class="user mb-4" action="action.php" method="POST" enctype="multipart/form-data">
        <div id="alert">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="atelier">Les ateliers</label>
            </div>
            <select class="custom-select" id="atelier" name="atelier">
                <option value="" selected>Choisissez un atelier</option>
                <?php foreach ($ateliers as $atelier) : ?>
                <option value="<?= $atelier['id']?>/<?= $atelier['date_atelier']?>"><?= $atelier['date_atelier']?></option>
                <?php endforeach?>
            </select>
        </div>
        <div id="groupe_creation">
            <div class="duplicate" id ="creation-1">
                <div class="upload text-left mb-3">
                    <label for="photo1">Création :</label>
                    <input class="browse "type="file" accept="image/png" class="d-block" name="photo1" aria-describedby="photolHelp">
                </div>
                <div class="form-group text-left">
                    <label for="legende1">Légende :</label>
                    <input type="text" class="form-control form-control-user" name="legende1" aria-describedby="legendeHelp">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-dark mr-5" name="btn_add" id="add_creation">Ajouter</button>
        <a class="btn btn-success" href="#" id="ajouter">Ajouter une creation</a>
        <a class="btn btn-danger" href="#" id="supprimer">Supprimer une creation</a>
     </form>
<?php
include '../inc/footer.php';
include '../inc/bottom.php';
?>