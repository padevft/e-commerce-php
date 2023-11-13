<?php
session_start();
require_once('./../membre/includes/Membre.php');
require_once('./../membre/modeleMembre.php');
function Ctr_Ajouter_Membre()
{

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $courriel = $_POST['courriel'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['daten'];
    $mdp = $_POST['mdp'];

    $res = Mdl_Membre_Par_Courriel($courriel);
    if ($res['success'] == false) {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
            $uploadDir = 'photos/';
            $uploadedFileName = $nom . '_' . basename($_FILES['avatar']['name']);
            $uploadedFile = $uploadDir . $uploadedFileName;
            echo $uploadedFile;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadedFile)) {
                $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, $uploadedFile);
            } else {
                return ['success' => false, 'message' => 'Erreur lors de l\'upload de l\'image'];
            }
        } else {
            $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten, "");
        }
        return Mdl_Ajouter_Membre($membre, $mdp);
    } else {
        $_SESSION['msg'] = 'Ce courriel est déja utilisé';
        header('Location: ../pages/signup.php');
        exit();
    }
}

function Ctr_Modifier_Membre()
{

    $idm = $_POST['idm'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $courriel = $_POST['courriel'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['daten'];
    $mdp = $_POST['mdp'];


    $res = Mdl_Membre_Par_ID($idm);
    if ($res['success'] == true) {
        $existingMembre = $res['data'];
        if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
            $uploadDir = 'photos/';
            $uploadedFileName = $nom . '_' . basename($_FILES['avatar']['name']);
            $uploadedFile = $uploadDir . $uploadedFileName;
            echo $uploadedFile;
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadedFile)) {
                if (file_exists($existingMembre->avatar)) {
                    unlink($existingMembre->avatar);
                }
                $membre = new Membre($idm, $nom, $prenom, $courriel, $sexe, $daten, $uploadedFile);
            } else {
                return ['success' => false, 'message' => 'Erreur lors de l\'upload de la nouvelle image'];
            }
        } else {
            $membre = new Membre($idm, $nom, $prenom, $courriel, $sexe, $daten, $existingMembre->avatar);
        }
        $response = Mdl_Modifier_Membre($membre, $mdp);
    } else {
        $response = ['success' => false, 'message' => $res['message']];
    }

    return $response;
}

function Ctr_Membres()
{
    $response = Mdl_Membres();
    return $response;
}

function Ctr_Modifier_Statut_Membre()
{
    $id = $_POST['id'];
    $statut = $_POST['statut'];
    return Mdl_Modifier_Statut_Membre($id, $statut);
}

function Ctr_Filtrer_Membres()
{
    $search = $_POST['search'];
    $response = Mdl_Filtrer_Membres($search);
    return $response;
}



$action = $_POST['action'];
switch ($action) {
    case 'inscription':
        echo Ctr_Ajouter_Membre();
        break;
    case 'modification-membre':
        echo Ctr_Modifier_Membre();
        break;
    case 'modification-statut':
        echo json_encode(Ctr_Modifier_Statut_Membre());
        break;
    case 'filtrer-membre':
        echo json_encode(Ctr_Filtrer_Membres());
        break;
}
