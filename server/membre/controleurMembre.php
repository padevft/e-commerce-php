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

    $membre = new Membre(0, $nom, $prenom, $courriel, $sexe, $daten);
    return Mdl_Ajouter_Membre($membre, $mdp);
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

    $membre = new Membre($idm, $nom, $prenom, $courriel, $sexe, $daten);
    return Mdl_Modifier_Membre($membre, $mdp);
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
    $response = Mdl_Modifier_Statut_Membre($id, $statut);
    return $response;
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
    case 'modification':
        echo Ctr_Filtrer_Membres();
        break;
}
