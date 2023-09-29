<?php 

    require_once('../env/env.inc.php');
    $connexion = new mysqli(SERVEUR,USAGER,MDP,BD);
    if($connexion->connect_errno){
        echo "Probleme de connexion au serveur de bd";
        exit();
    }

?>