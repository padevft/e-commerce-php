<?php
// session_start();
require_once('./../category/includes/Category.php');
require_once('./../category/modeleCategory.php');







/********************************************************************************************
 * 
 * 
 * --                                   SECTION CATEGORIE
 * 
 * 
 *********************************************************************************************/

function Ctr_Categs()
{
    $response = Mdl_Categs();
    return $response;
}


function Ctr_Ajouter_Categ()
{
    $nom = $_POST['nom'];
    $category = new Category(0, $nom);
    $response = Mdl_Ajouter_Categ($category);
    return $response;
}


function Ctr_Modifier_Categ()
{
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $category = new Category($id, $nom);
    $response = Mdl_Modifier_Categ($category);
    return $response;
}

function Ctr_Filtrer_Categ()
{
    $search = $_POST['search'];
    $response = Mdl_Filtrer_Categs($search);
    return $response;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'add-categ') {
            $response = Ctr_Ajouter_Categ();
            echo json_encode($response);
        } elseif ($action === 'update-categ') {
            $response = Ctr_Modifier_Categ();
            echo json_encode($response);
        } elseif ($action === 'filter-categ') {
            $response = Ctr_Filtrer_Categ();
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
