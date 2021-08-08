<?php
include 'config/config.php';
include 'config/bdd.php';

var_dump($_POST);
if (isset($_POST['btn-login'])) {
    unset($_POST['btn-login']);
    foreach ($_POST as $index => $value) {
        if (empty($value)) {
            $errors[]= $index;
        }
    }
    // var_dump($errors);
    if (isset($errors)) {
       $_SESSION['errors']=$errors; 
       header('location:login.php');
       die;
    }
    // Je fais une recherche en bdd à partir du mail renseigné
    $sql = 'SELECT utilisateurs.id as id_utilisateur, nom, prenom, mail, mot_de_passe, avatar, id_roles, libelle  FROM utilisateurs_roles 
        INNER JOIN roles ON roles.id=utilisateurs_roles.id_roles 
        INNER JOIN utilisateurs ON utilisateurs.id=utilisateurs_roles.id_utilisateurs WHERE mail="'.$_POST['mail'].'"';
    // var_dump($sql);
    $req=$bdd->prepare($sql);
    if ($req->execute()) {
        $utilisateur= $req->fetch(PDO::FETCH_ASSOC);
        // var_dump($utilisateur); 
        if ($utilisateur=== false) { 
            $_SESSION['login']= false;
            header('location:login.php'); 
            die(); 
        }
        if ($utilisateur['id_roles'] === '2') { // Verification si user a l'autorisation au backoffice
            header('location:'.URL.'pages/index.php');
            die();
        }
        
        $mdp=$utilisateur['mot_de_passe'];
        // var_dump(password_verify($_POST['mdp'],$mdp));
        if (!password_verify($_POST['mdp'],$mdp)) { // Verif MDP entré par user avec mdp en BDD
            $_SESSION['login']= false;
            header('location:login.php');
            die();
        }
        $_SESSION['login']=true;
        unset($utilisateur['mot_de_passe']);
            // var_dump($utilisateur);
            $_SESSION['utilisateur']=$utilisateur;
            header('location:index.php');
        // var_dump( $_SESSION['utilisateur']['libelle']);
        
        
    }
}