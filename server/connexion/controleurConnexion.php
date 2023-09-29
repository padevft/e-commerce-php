<?php
session_start();
require_once('./modeleConnexion.php');
function Ctr_Connexion()
{

    $courriel = $_POST['courriel'];
    $mdp = $_POST['mdp'];

    return Mdl_Connexion($courriel, $mdp);
}
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
Ctr_Connexion();
?>
<br />
<a href="../../index.php">Retour a la page d'acceuil</a>