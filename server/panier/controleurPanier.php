<?php
session_start();
require_once('./../panier/includes/Panier.php');
require_once('./../panier/modelePanier.php');


/********************************************************************************************
 * 
 * 
 * --                                   SECTION PANIER
 * 
 * 
 *********************************************************************************************/

function Ctr_Produits_Panier()
{
    $idm = $_POST['idm'];
    $response = Mdl_Produits_Panier($idm);
    return $response;
}

function Ctr_Ajouter_Produit_Panier()
{
    $idm = $_POST['idm'];
    $idp = $_POST['idp'];
    $quantite = $_POST['quantite'];

    $panier = new Panier($idm, $idp, $quantite,  date("Y-m-d"));
    $res = Mdl_Produit_Panier_Par($panier);
    if ($res['success']) {
        if ($res['message'] == "1") {
            $panier->setQuantite($res['quantite']);
            return Mdl_Modifier_Produit_Panier($panier);
        } else {
            return Mdl_Ajouter_Produit_Panier($panier);
        }
    } else {
        return ['success' => false, 'message' => $res['message']];
    }
}


function Ctr_Modifier_Produit_Panier()
{
    $idm = $_POST['idm'];
    $idp = $_POST['idp'];
    $quantite = $_POST['quantite'];

    $panier = new Panier($idm, $idp, $quantite,  date("Y-m-d"));
    return Mdl_Modifier_Produit_Panier($panier);
}



function Ctr_Supprimer_Produit_Panier()
{
    $idm = $_POST['idm'];
    $idp = $_POST['idp'];
    $panier = new Panier($idm, $idp, 1,  date("Y-m-d"));
    return Mdl_Supprimer_Produit_Panier($panier);
}


function Ctr_Payer_Panier()
{
    $idm = $_POST['idm'];
    return Mdl_Payer_Panier($idm);
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'add-panier') {
            $response = Ctr_Ajouter_Produit_Panier();
            echo json_encode($response);
        } elseif ($action === 'update-panier') {
            $response = Ctr_Modifier_Produit_Panier();
            echo json_encode($response);
        } elseif ($action === 'delete-panier') {
            $response = Ctr_Supprimer_Produit_Panier();
            echo json_encode($response);
        } elseif ($action === 'payer-panier') {
            echo Ctr_Payer_Panier();
        } else {
            $response = ['success' => false, 'message' => 'Action non reconnue'];
            echo json_encode($response);
        }
    } else {
        $response = ['success' => false, 'message' => 'Action manquante'];
        echo json_encode($response);
    }
} else {
    $response = ['success' => false, 'message' => 'Méthode non autorisée'];
    echo json_encode($response);
}
