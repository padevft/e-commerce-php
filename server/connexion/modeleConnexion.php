<?php
require_once('../bd/connexion.inc.php');
function Mdl_Connexion($courriel, $mdp)
{
    global $connexion;
    $sqlSelectCourriel = "SELECT * FROM connexion WHERE courriel = ? AND pass=?";
    $sqlMembre = "SELECT * FROM membres WHERE courriel = ?";

    try {
        $stmt = $connexion->prepare($sqlSelectCourriel);
        $stmt->bind_param("ss", $courriel, $mdp);
        $stmt->execute();
        $reponse = $stmt->get_result();
        if ($reponse->num_rows > 0) {
            $ligne = $reponse->fetch_object();
            if ($ligne->statut == 'A') {
                $role = $ligne->role;
                $mdp = $ligne->pass;
                $stmt = $connexion->prepare($sqlMembre);
                $stmt->bind_param("s", $courriel);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $ligne = $reponse->fetch_object();
                $_SESSION['role'] = $role;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['idm'] = $ligne->idm;
                $_SESSION['nom'] = $ligne->nom;
                $_SESSION['prenom'] = $ligne->prenom;
                $_SESSION['courriel'] = $ligne->courriel;
                $_SESSION['sexe'] = $ligne->sexe;
                $_SESSION['datenaissance'] = $ligne->datenaissance;
                if ($role === "M") {
                    header('Location: ../pages/membre.php');
                    exit();
                } elseif ($role === "A") {
                    header('Location: ../pages/admin.php');
                    exit();
                }
            } else {
                $msg = "SVP contactez l'administrateur  !!!";
            }
        } else {
            $msg =  "Impossible de se connecter  !!!";
        }
    } catch (Exception $e) {
        $msg = "Erreur : " . $e->getMessage() . '<br>';
    } finally {
        return $msg;
    }
}
