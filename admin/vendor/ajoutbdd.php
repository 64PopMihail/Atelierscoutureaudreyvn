<?php
include 'config/bdd.php';
// var_dump('COUCOU');
// for ($i=0; $i < 103; $i++) { 
//     $nom = "test".$i;
//     $prenom = "test".$i;
//     $mail = "mail".$i."@gmail.com";
//     $mdp =  password_hash("azerty$i",PASSWORD_DEFAULT);
//     var_dump($nom.' | '.$prenom.' | '.$mail.' | '.$mdp);
//     $sql = 'INSERT INTO utilisateurs VALUES (NULL,"'.$nom.'","'.$prenom.'","'.$mail.'","'.$mdp.'","testavatar.png",0)';
//     var_dump($sql);
//     $req = $bdd->prepare($sql);
//     if ($req->execute()) {
//         $id_client = $bdd->lastInsertId();
//         $sql = 'INSERT INTO utilisateurs_roles VALUES ("'.$id_client.'","2")';
//         $req = $bdd->prepare($sql);
//         if($req->execute()){
//             var_dump('OK'.$i);
//         }
//     }
    

// }