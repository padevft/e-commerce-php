<?php
// session_start();
require_once('./../product/includes/Produit.php');
require_once('./../product/modeleProduit.php');


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
    $uploadedFileName = $title . '_' . basename($_FILES['img-product']['name']); // Ajout du nom du produit au début du nom du fichier
    $uploadedFile = $uploadDir . $uploadedFileName;

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
            $uploadedFileName = $title . '_' . basename($_FILES['img-product']['name']); // Ajout du nom du produit au début du nom du fichier
            $uploadedFile = $uploadDir . $uploadedFileName;
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




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'add-product') {
            $response = Ctr_Ajouter_Produit();
            echo json_encode($response);
        } elseif ($action === 'update-product') {
            $response = Ctr_Modifier_Produit();
            echo json_encode($response);
        } elseif ($action === 'delete-product') {
            $response = Ctr_Supprimer_Produit();
            echo json_encode($response);
        } elseif ($action === 'filter-product') {
            $response = Ctr_Filtrer_Produits();
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
