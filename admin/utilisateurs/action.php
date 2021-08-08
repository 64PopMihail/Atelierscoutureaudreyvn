<?php
// session_start();
include '../config/config.php';
include '../config/bdd.php';
var_dump($_POST);
var_dump($_FILES);

if (isset($_POST['btn_update'])) {
    unset($_POST['btn_update']);
    foreach ($_POST as $index => $value) {
        if ($value==='') {
            $errors[]= $index;
        }
    }
    
    // if ($_FILES['avatar']['error'] > 0) {
    //     $errors_file='fichier';
    // }
    // if (isset($errors_file)) {
    //     var_dump($errors_file);
    //     $_SESSION['errors'][]= $errors_file;
    //     echo'CA DECONNE ICI';
    //     // header('location:update.php?id='.$_POST['id']);
    //     die;
    // }
    
    if (!isset($_POST['role'])) {
        $errors[] = 'rôle';
    }    
    if (isset($errors)) {
        var_dump($errors);
        $_SESSION['errors']=$errors;
        echo'CA DECONNE ICI 1';
        header('location:update.php?id='.$_POST['id']);
        die;
        // echo'CA DECONNE ICI';
    }
     if ($_FILES['avatar']['error'] === 0) {
            $avatar_final= $_FILES['avatar']['name'];
            $upload_dir='../avatars/'.$avatar_final;
            var_dump($upload_dir);
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'],$upload_dir)) {
                $errors_file='fichier';
                $_SESSION['errors'][]=$errors_file;
                // echo'Erreur upload';
                // echo'CA DECONNE ICI 2';
                header('location:update.php?id='.$_POST['id']);
                die;
            }
    }
    elseif ($_FILES['avatar']['error'] === 4) {
        $sql='SELECT avatar FROM utilisateurs WHERE id='.$_POST["id"];
        $req = $bdd->prepare($sql);
        if ($req->execute()) {
            $avatar=  $req->fetch(PDO::FETCH_ASSOC);
            $avatar_final= $avatar['avatar'];
            var_dump($avatar_final);
            
        }
    }
    else {
        $errors_file='fichier';
        var_dump($errors_file);
        $_SESSION['errors'][]= $errors_file;
        // echo'CA DECONNE ICI';
        header('location:update.php?id='.$_POST['id']);
        die;
    
        
    }
        
    $id= intval($_POST["id"]);
    if ($id > 0) {
        $sql= 'UPDATE utilisateurs SET nom="'.$_POST["nom"].'",prenom="'.$_POST["prenom"].'",pseudo="'.$_POST["pseudo"].'",mail="'.$_POST["mail"].'", avatar="'.$avatar_final.'" WHERE id="'.$id.'"';
        // var_dump($sql);
        // die;
        $req= $bdd->prepare($sql);
        if (isset($errors)) {
            var_dump($errors);
            $_SESSION['errors']=$errors;
            header('location:update.php?id='.$id);
            // echo'CA DECONNE ICI 3';
            die;
        }
        else {
            $req->execute();
            $_SESSION['update']= $_POST['id'];
            var_dump($_POST['role']);
            $sql='DELETE FROM utilisateurs_roles WHERE id_utilisateur='.$id;
            var_dump($sql);
            $req= $bdd->prepare($sql);
            $req->execute();
            if (!$req->execute()) {
                echo'CA DECONNE ICI 4';
                die;
            }
            
            
            foreach ($_POST['role'] as $role) {
                $sql='INSERT INTO utilisateurs_roles VALUES ('.$id.','.$role.')';
                var_dump($sql);
                $req=$bdd->prepare($sql);
                if (!$req->execute()) {
                    echo'CA DECONNE ICI 5';
                    die;
                }
                
            }
            header('location:index.php'); 
            die;
        }
    }
    
}
if (isset($_POST['btn_add'])) {
    unset($_POST['btn_add']);
    foreach ($_POST as $index => $value) {
        if ($value==='') {
            $errors[]= $index;
        }
    }
    
    if ($_FILES['avatar']['error']!=0) {
        $errors_file[]=$key;
    }

    if (isset($errors_file)) {
        unset($errors_file['error']);
        var_dump($errors_file);
        $_SESSION['errors'][]= 'fichier';
        header('location:add.php');
        die;
    }
    if (!isset($_POST['role'])) {
        $errors[] = 'rôle';
    }    
    if (isset($errors)) {
        var_dump($errors);
        $_SESSION['errors']=$errors;
        header('location:add.php?');
        die;
        // echo'CA DECONNE ICI';
    }
    // else {
        $avatar= $_FILES['avatar']['name'];
        $upload_dir='../avatars/'.$avatar;
        // var_dump($upload_dir);
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'],$upload_dir)) {
            $_SESSION['error_upload']=true;
            // echo'Erreur upload';
            header('location:add.php');
            die;
        }
        // echo 'ça marche';

        $_SESSION['add']= true;
        $mdp= password_hash($_POST['mdp'],PASSWORD_DEFAULT);
        var_dump($mdp);
        $sql='INSERT INTO utilisateurs VALUES (NULL, "'.$_POST["nom"].'","'.$_POST["prenom"].'","'.$_POST["mail"].'","'.$mdp.'","'.$avatar.'", "0")';
        // var_dump($sql);
        $req= $bdd->prepare($sql);
        if ($req->execute()) {
            header('location:index.php');
            // echo 'ok';
            $id= $bdd->lastInsertId();
            var_dump($id);
            foreach ($_POST['role'] as $role) {
                $sql='INSERT INTO utilisateurs_roles VALUES ('.$id.','.$role.')';
                //    var_dump($sql);
                $req= $bdd->prepare($sql); 
                $req->execute();
        }
        die; 
        }
        
    // }
    
    
}
if (isset($_GET['id'])) {
    $sql= 'UPDATE utilisateurs SET statut="1" WHERE id='.$_GET['id'];
    // var_dump($sql);
    $req= $bdd->prepare($sql);
    if ($req->execute()) {
        $_SESSION['delete']=true;
        header('location:index.php');
        die;
    }
    
}
