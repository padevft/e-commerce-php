<?php

require_once('../bd/connexion.inc.php');
function Mdl_Ajouter_Membre($membre, $mdp)
{
    global $connexion;
    $nom = $membre->getNom();
    $prenom = $membre->getPrenom();
    $courriel = $membre->getCourriel();
    $sexe = $membre->getSexe();
    $daten = $membre->getDaten();

    $sqlInsertMembre = "INSERT INTO membres VALUES (0,?, ?, ?, ?, ?)";
    $sqlInsertConnexion = "INSERT INTO connexion VALUES (?,?, ?, 'M', 'A')";
    $sqlSelectMembre = "SELECT * FROM membres WHERE courriel = ?";
    try {

        //Tester si le couriel existe deja
        $stmt = $connexion->prepare($sqlSelectMembre);
        $stmt->bind_param("s", $courriel);
        $stmt->execute();
        $reponse = $stmt->get_result();

        if ($reponse->num_rows == 0) {
            $stmt = $connexion->prepare($sqlInsertMembre);
            $stmt->bind_param("sssss", $nom, $prenom, $courriel, $sexe, $daten);
            $stmt->execute();
            $idm = $connexion->insert_id;

            $stmt = $connexion->prepare($sqlInsertConnexion);
            $stmt->bind_param("iss", $idm, $courriel, $mdp);
            $stmt->execute();
            $msg = "Compte crée";
            $_SESSION['role'] = 'M';
            $_SESSION['mdp'] = $mdp;
            $_SESSION['idm'] = $idm;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['courriel'] = $courriel;
            $_SESSION['sexe'] = $sexe;
            $_SESSION['datenaissance'] = $daten;
            header('Location: ../pages/membre.php');
            exit();
        } else {
            $msg = "Ce courriel est déja utilisé";
        }
    } catch (Exception $e) {
        $msg = "Erreur : " . $e->getMessage() . '<br>';
    } finally {
        return $msg;
    }
}

function Mdl_Modifier_Membre($membre, $nouveauMdp)
{
    global $connexion;

    $idm = $membre->getIdm();
    $nom = $membre->getNom();
    $prenom = $membre->getPrenom();
    $courriel = $membre->getCourriel();
    $sexe = $membre->getSexe();
    $daten = $membre->getDaten();


    $sqlUpdateMembre = "UPDATE membres SET nom=?, prenom=?, sexe=?, datenaissance=? WHERE courriel=?";
    $sqlUpdateConnexion = "UPDATE connexion SET pass=? WHERE courriel=?";

    try {
        $stmt = $connexion->prepare($sqlUpdateMembre);
        $stmt->bind_param("sssss", $nom, $prenom, $sexe, $daten, $courriel);
        $stmt->execute();

        $stmt = $connexion->prepare($sqlUpdateConnexion);
        $stmt->bind_param("ss", $nouveauMdp, $courriel);
        $stmt->execute();
        $_SESSION['success-p'] = 1;
        $_SESSION['msg'] = "Profile mis à jour avec succès";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Erreur : " . $e->getMessage() . '<br>';
        $_SESSION['success-p'] = 0;
    } finally {
        $_SESSION['role'] = 'M';
        $_SESSION['mdp'] = $nouveauMdp;
        $_SESSION['idm'] = $idm;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['courriel'] = $courriel;
        $_SESSION['sexe'] = $sexe;
        $_SESSION['datenaissance'] = $daten;
        header('Location: ../pages/membre.php');
        exit();
    }
}

function Mdl_Membres()
{
    global $connexion;

    // $requete ="SELECT * FROM membres";
    $requete = "SELECT m.idm, m.nom, m.prenom, m.courriel, m.sexe, m.datenaissance, c.statut AS status_membre 
                FROM membres m
                LEFT JOIN connexion c ON m.idm = c.idm
                ORDER BY m.nom";

    try {
        $stmt = $connexion->prepare($requete);
        $stmt->execute();
        $stmt->bind_result($idm, $nom, $prenom, $courriel, $sexe, $datenaissance, $status_membre);

        $membres = array();

        while ($stmt->fetch()) {
            $membres[] = [
                'id' => $idm,
                'nom' => $nom,
                'prenom' => $prenom,
                'courriel' => $courriel,
                'sexe' => $sexe,
                'datenaissance' => $datenaissance,
                'statut' => $status_membre,
            ];
        }

        $stmt->close();

        $response = ['success' => true, 'data' => $membres];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}

function Mdl_Modifier_Statut_Membre($id, $statut)
{
    global $connexion;

    $requette = "UPDATE connexion SET statut = ? WHERE idm = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("si", $statut, $id);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Mis à jour", 'membres' => Mdl_Membres()];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}

function Mdl_Filtrer_Membres($search)
{
    global $connexion;
    $requete = "SELECT m.idm, m.nom, m.prenom, m.courriel, m.sexe, m.datenaissance, c.statut AS status_membre 
                FROM membres m
                LEFT JOIN connexion c ON m.idm = c.idm
                WHERE m.nom LIKE ?
                ORDER BY m.nom";

    try {
        $stmt = $connexion->prepare($requete);
        $searchParam = "%$search%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $stmt->bind_result($idm, $nom, $prenom, $courriel, $sexe, $datenaissance, $status_membre);

        $membres = array();

        while ($stmt->fetch()) {
            $membres[] = [
                'id' => $idm,
                'nom' => $nom,
                'prenom' => $prenom,
                'courriel' => $courriel,
                'sexe' => $sexe,
                'datenaissance' => $datenaissance,
                'statut' => $status_membre,
            ];
        }

        $stmt->close();

        $response = ['success' => true, 'data' => $membres];
    } catch (Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}
