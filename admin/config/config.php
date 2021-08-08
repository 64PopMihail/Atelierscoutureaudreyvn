<?php
session_start();
define ( 'URL' , 'http://localhost/atelierscoutureaudreyvn/');
define ('URLADMIN', 'http://localhost/atelierscoutureaudreyvn/admin/');

function selectSql($bdd1,$tab,$condition){
    $sql="SELECT * FROM $tab $condition";
    // var_dump($sql);
    $req= $bdd1->prepare($sql);
    $req->execute();
    $entite= $req->fetchAll(PDO::FETCH_ASSOC);
    return $entite;
}
function select1Sql($bdd1,$tab,$condition){
    $sql="SELECT * FROM $tab $condition";
    // var_dump($sql);
    $req= $bdd1->prepare($sql);
    $req->execute();
    $entite= $req->fetch(PDO::FETCH_ASSOC);
    return $entite;
}

function insertSql($bdd1,$tab,$valeurs){
    $sql="INSERT INTO $tab VALUES ($valeurs) ";
    // var_dump($sql);
    $req=$bdd1->prepare($sql);
    if ($req->execute()) {
        return true;
    }
    else{
        return false;
    }
}
function superAlert($couleur, $content) // je crée une fonction qui va gérer toutes mes alertes désignant 2 paramètres
{?>
<div class="alert alert-<?= $couleur?> alert-dismissible fade show" role="alert">
    <?= $content?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php }
function superSuccess($session,$sujet,$action){
    // var_dump($_SESSION[$session]);
    if (isset($_SESSION[$session])) {
        superAlert("success","".$sujet." a bien été ".$action.".");
        unset($_SESSION[$session]);
    }
    
}
function Error($session,$sujet,$action){
    // var_dump($_SESSION[$session]);
    if (isset($_SESSION[$session])) {
        superAlert("danger","".$sujet." n'a pas été ".$action.".");
        unset($_SESSION[$session]);
    }
    
}
function ErrorDate($msg){
    // var_dump($_SESSION[$session]);
    if (isset($_SESSION['error_date'])) {
        superAlert("danger",$msg);
        unset($_SESSION['error_date']);
    }
    
}
function superErrorContact($sujet,$action){
    if (isset($_SESSION['errors_contact'])) {
        $message= implode(', ', $_SESSION['errors_contact']);
        if (count($_SESSION['errors_contact'])===1) {
            superAlert("danger","".$sujet." n'a pas pu être ".$action." car le champs ".$message." est vide.");
        }
        else {
            superAlert("danger","".$sujet." n'a pas pu être ".$action." car les champs ".$message." sont vides.");
        }
        unset($_SESSION['errors_contact']);
    }
}
function superError(){
    if (isset($_SESSION['error'])) {
            superAlert("danger",$_SESSION['error']);
        
        unset($_SESSION['error']);
    }
}
function superErrorFile(){
    if (isset($_SESSION['errors_files'])) {
        superAlert("danger",$_SESSION['errors_files']);
        unset($_SESSION['errors_files']);
    }
}

function loginVerify (){
    if (!isset($_SESSION['utilisateur'])) {
        return false;
    }
    return true;
}

function formatDate($date){
    if (!empty($date)){
        $date_str= $date;
        $date= date_create($date_str);
        $date_formate= date_format($date, 'd/m/Y H:i');
        
    }else{
        $date_formate = null;
    }
    return $date_formate;
}
function formatDateBdd($date){
    if (!empty($date)){
        $date_str= $date;
        $date= date_create($date_str);
        $date_formate= date_format($date, 'Y-m-d H:i:s');
        
    }else{
        $date_formate = null;
    }
    return $date_formate;
}
function formatDateFichierDirection($date){
    if (!empty($date)){
        $date_str= $date;
        $date= date_create($date_str);
        $date_formate= date_format($date, 'd-m-Y');
        
    }else{
        $date_formate = null;
    }
    return $date_formate;
}
$today = date('Y-m-d H-i-s');
$todaySql = date('Y-m-d H:i:s');


function pickRoles($role1){
    if ($role1 === $_SESSION['utilisateur']['libelle']) {
        $role = true;
    }
    else{
        $role = false;
    }
    

    return $role ;
}
function sqlCount($tab,$bdd1,$condition){
    $sql="SELECT COUNT(*) FROM $tab $condition";
    $req= $bdd1->prepare($sql);
    if ($req->execute()) {
    $count= $req->fetch(PDO::FETCH_ASSOC);
        // var_dump($count);
    }   
return $count;
}