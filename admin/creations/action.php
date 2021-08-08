<?php
include '../config/config.php';
include '../config/bdd.php';
if (empty($_POST) && empty($_FILES)) {
    header('location:add.php');
    die();
}
if (isset($_POST['btn_add'])) {
    unset($_POST['btn_add']);
    var_dump($_POST, $_FILES);
    foreach ($_POST as $key => $value) { 
        if (empty($value)) { // Verif champs vides
            $errors[]= $key;
        }
    }
    if (isset($errors)) {
        $_SESSION['error']= "Le ou les champs ".implode(", ",$errors)." sont vides"; 
        header('location:add.php');
        die();
    }
    foreach ($_FILES as $file) {
        if ($file['error'] !== 0) { // Verif input vide ou non uploadé
            $_SESSION['error'] = "Le ou les fichiers n'ont pas pu être ajoutés";
            header('location:add.php');
            die();
        }// Verif type de fichier uploadé
        if ($file['type']!='image/png' && $file['type']!= 'image/jpg' && $file['type']!='image/jpeg' ) {
            $_SESSION['error'] = "Seuls les fichiers .jpg .jpeg .png sont autorisés";
            header('location:add.php');
            die();
        }
    }
    $infos = explode("/",$_POST['atelier']); 
    $id_atelier = $infos[0]; 
    $date_atelier = formatDateFichierDirection($infos[1]);
    unset($_POST['atelier']); 
    $creations = array(); 
    $compteur = 0;
    foreach ($_POST as $key => $value) { // Boucle sur les tableaux pour regrouper chaque légende avec sa photo dans le nouveau tableau
        $creations[$compteur]['legende']= $value;
        $compteur++; 
    }
    $compteur = 0;
    foreach ($_FILES as $key => $value) { 
        $creations[$compteur]+= $value; 
        $compteur++;
    }
    // var_dump($creations);
    if (!is_dir("../img/img_creations/$date_atelier")) { // Si ce dossier n'existe pas je le crée avec la fonction mkdir()
        mkdir("../img/img_creations/$date_atelier");
    }
    $chemin = "../img/img_creations/$date_atelier"; 
    foreach ($creations as $creation) { // Pour chaque création
        $photo = $creation['name'] ;
        $upload_directory = "$chemin/$photo";
        if (!move_uploaded_file($creation['tmp_name'],$upload_directory)) { // Je déplace la photo dans mon dossier image
            $_SESSION['error']="Le fichier n'a pas pu être déplacé";
            header('location:add.php');
            die('NOK UPLOAD FILE');
        }
        // J'insère dans la base de données chaque création 
        $sql = 'INSERT INTO creations VALUES (NULL,"'.$photo.'","'.$creation['legende'].'" )';
        // var_dump($sql);
        $req = $bdd->prepare($sql);
        if (!$req->execute()) {
            $_SESSION['error'] = "La création n'a pas pu être ajoutée en base de donnée";
            header('location:add.php');
           die('SQL CREATION NOT OK');
        }
        $id_creation = $bdd->lastInsertId();// Je récupère l'id du dernier élément créé en bases de données
        // J'associe en base de données l'atelier à la création
        $sql = 'INSERT INTO ateliers_creations VALUES ("'.$id_atelier.'","'.$id_creation.'")';
        // var_dump($sql);
        $req = $bdd->prepare($sql);
        if(!$req->execute()){
            $_SESSION['error']="La création n'a pas pu être associée à un atelier";
            header('location:add.php');
            die('SQL ATELIERS CREATIONS NOT OK');
        }
    }
    $_SESSION['add']= true;
        header('location:index.php');
        die();
}