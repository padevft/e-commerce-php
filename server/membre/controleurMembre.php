<?php
    session_start();
    require_once('./includes/Membre.php');
    require_once('./modeleMembre.php');
    function Ctr_Ajouter(){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $sexe = $_POST['sexe'];
        $daten = $_POST['daten'];
        $mdp = $_POST['mdp'];

        $membre = new Membre(0,$nom, $prenom, $courriel, $sexe, $daten);
        return Mdl_Ajouter($membre,$mdp);
    }
    $msg = Ctr_Ajouter();

    echo $msg;
?>
<br />
<a href="../../index.php">Retour a la page d'acceuil</a>