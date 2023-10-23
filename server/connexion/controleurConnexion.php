<?php
session_start();
require_once('./modeleConnexion.php');
function Ctr_Connexion()
{

    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];

    return Mdl_Connexion($courriel, $mdp);
}

function Ctr_Deconnexion()
{

    unset($_SESSION);
    session_destroy();
    header('Location: ../../index.php');
    exit();
}

$action = $_POST['action'];
switch ($action) {
    case 'connexion':
        $response = Ctr_Connexion();
        if ($response === "M") {
            $_SESSION['role'] = "M";
            header('Location: ../pages/membre.php');
            exit();
        } elseif ($response === "A") {
            $_SESSION['role'] = "A";
            header('Location: ../pages/admin.php');
            exit();
        } else {
            // Gérer d'autres cas d'erreur ici
            echo $response;
        }
        break;
    case 'deconnexion':
        echo Ctr_Deconnexion();
        break;
}

?>
<br />
<a href="../../index.php">Retour a la page d'acceuil</a>