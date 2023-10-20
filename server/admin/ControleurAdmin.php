<?php
session_start();
require_once('./includes/Produit.php');
require_once('./modeleAdmin.php');


/********************************************************************************************
 * 
 * 
 * --                                   SECTION PRODUIT
 * 
 * 
 *********************************************************************************************/

function Ctr_Produits()
{
    $response = Mdl_Produits();
    return $response;
}

function Ctr_Filtrer_Produits()
{
    $category = $_POST['category'];
    $sort = $_POST['sort'];
    $search = $_POST['search'];
    $response = Mdl_Filtrer_Produits($category, $sort, $search);
    return $response;
}

function Ctr_Ajouter_Produit()
{
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];


    $uploadDir = 'pochettes/';
    $uploadedFile = $uploadDir . basename($_FILES['img-product']['name']);

    if (move_uploaded_file($_FILES['img-product']['tmp_name'], $uploadedFile)) {
        $produit = new Produit(0, $title, $category, $price, $quantity, $description, date("Y-m-d"), $uploadedFile);
        $response = Mdl_Ajouter_Produit($produit);
    } else {
        $response = ['success' => false, 'message' => 'Erreur lors de l\'upload de l\'image'];
    }
    return $response;
}


function Ctr_Modifier_Produit()
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $res = Mdl_Produit_Par_ID($id);
    if ($res['success'] == true) {
        $existingProduct = $res['data'][0];
        if (isset($_FILES['img-product']) && $_FILES['img-product']['size'] > 0) {
            $uploadDir = 'pochettes/';
            $uploadedFile = $uploadDir . basename($_FILES['img-product']['name']);
            if (move_uploaded_file($_FILES['img-product']['tmp_name'], $uploadedFile)) {
                if (file_exists($existingProduct['pochette'])) {
                    unlink($existingProduct['pochette']);
                }
                $produit = new Produit($id, $title, $category, $price, $quantity, $description, date("Y-m-d"), $uploadedFile);
            } else {
                $response = ['success' => false, 'message' => 'Erreur lors de l\'upload de la nouvelle image'];
                return $response;
            }
        } else {
            $produit = new Produit($id, $title, $category, $price, $quantity, $description, $existingProduct['date_ajout'], $existingProduct['pochette']);
        }

        $response = Mdl_Modifier_Produit($produit);
    } else {
        $response = ['success' => false, 'message' => 'Impossible de modifier'];
    }

    return $response;
}



function Ctr_Supprimer_Produit()
{
    $id = $_POST['id'];

    $res = Mdl_Produit_Par_ID($id);
    if ($res['success'] == true) {
        $existingProduct = $res['data'][0];
        if (file_exists($existingProduct['pochette'])) {
            unlink($existingProduct['pochette']);
        }
        $response = Mdl_Supprimer_Produit($id);
    } else {
        $response = ['success' => false, 'message' => 'Impossible de supprimer'];
    }

    return $response;
}










/********************************************************************************************
 * 
 * 
 * --                                   SECTION CATEGORIE
 * 
 * 
 *********************************************************************************************/


function Ctr_Ajouter_Categ()
{
    $nom = $_POST['nom'];
    $response = Mdl_Ajouter_Categ($nom);
    return $response;
}
function Ctr_Categs()
{
    $response = Mdl_Categs();
    return $response;
}

function Ctr_Modifier_Categ()
{
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $response = Mdl_Modifier_Categ($id, $nom);
    return $response;
}

function Ctr_Filtrer_Categ()
{
    $search = $_POST['search'];
    $response = Mdl_Filtrer_Categs($search);
    return $response;
}








/********************************************************************************************
 * 
 * 
 * --                                   SECTION MEMBRE
 * 
 * 
 *********************************************************************************************/

 function Ctr_Membres()
 {
     $response = Mdl_Membres();
     return $response;
 }

 function Ctr_Modifier_Membre()
{
    $id = $_POST['id'];
    $statut = $_POST['statut'];
    $response = Mdl_Modifier_Membre($id, $statut);
    return $response;
}

function Ctr_Filtrer_Membre()
{
    $search = $_POST['search'];
    $response = Mdl_Filtrer_Membre($search);
    return $response;
}
 









if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'add-product') {
            $response = Ctr_Ajouter_Produit();
            echo json_encode($response);
        } elseif ($action === 'add-categ') {
            $response = Ctr_Ajouter_Categ();
            echo json_encode($response);
        } elseif ($action === 'update-product') {
            $response = Ctr_Modifier_Produit();
            echo json_encode($response);
        } elseif ($action === 'update-categ') {
            $response = Ctr_Modifier_Categ();
            echo json_encode($response);
        }elseif ($action === 'update-membre') {
            $response = Ctr_Modifier_Membre();
            echo json_encode($response);
        } elseif ($action === 'delete-product') {
            $response = Ctr_Supprimer_Produit();
            echo json_encode($response);
        } elseif ($action === 'delete-categ') {
            $response = Ctr_Supprimer_Produit();
            echo json_encode($response);
        } elseif ($action === 'filter-product') {
            $response = Ctr_Filtrer_Produits();
            echo json_encode($response);
        } elseif ($action === 'filter-categ') {
            $response = Ctr_Filtrer_Categ();
            echo json_encode($response);
        }elseif ($action === 'filter-membre') {
            $response = Ctr_Filtrer_Membre();
            echo json_encode($response);
        }elseif ($action === 'list') {
            $res_produits = Ctr_Produits();
            $res_categs = Ctr_Categs();
            $res_membres = Ctr_Membres();
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
