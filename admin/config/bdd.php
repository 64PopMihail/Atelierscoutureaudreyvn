<?php
$user = 'atelierscoutureaudreyvn';
$password = 'j7KoQq08nAiGLGKn';


try { // On crée une nouvelle instance de PDO, qui réprésente la connexion à la bdd
    $bdd = new PDO('mysql:dbname='.$user.';charset=UTF8;host=127.0.0.1', $user, $password);
} catch (PDOException $e) { 
    echo 'Connexion échouée : ' . $e->getMessage();
}
