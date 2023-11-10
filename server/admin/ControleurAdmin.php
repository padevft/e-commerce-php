<?php
// session_start();
require_once('./../product/modeleProduit.php');
require_once('./../category/modeleCategory.php');
require_once('./../membre/modeleMembre.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'list') {
            $res_produits = Mdl_Produits();
            $res_categs = Mdl_Categs();
            $res_membres = Mdl_Membres();
            $reponse = array();
            if ($res_produits['success'] == true) {
                $response['produits'] = $res_produits['data'];
            }
            if ($res_categs['success'] == true) {
                $response['categories'] = $res_categs['data'];
            }
            if ($res_membres['success'] == true) {
                $response['membres'] = $res_membres['data'];
            }
            echo json_encode($response);
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
