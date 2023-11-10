<?php

require_once('../bd/connexion.inc.php');
require_once('../includes/utilitaires.inc.php');


/********************************************************************************************
 * 
 * 
 * --                                   SECTION CATEGORIE
 * 
 * 
 *********************************************************************************************/
function Mdl_Ajouter_Categ($category)
{
    global $connexion;
    $nom = $category->getNom();
    $requette = "INSERT INTO categories (nom) VALUES (?)";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $idp = $connexion->insert_id;
        $response = ['success' => true, 'message' => 'Catégorie ajoutée'];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}
function Mdl_Categs()
{
    global $connexion;
    // $requette = "SELECT id, nom  FROM categories ORDER BY nom";
    $requette = "SELECT c.id, c.nom, COUNT(p.id) as nombre_produits FROM categories c 
                 LEFT JOIN produits p ON c.id = p.categorie 
                 GROUP BY c.id, c.nom 
                 ORDER BY c.nom";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->execute();
        $stmt->bind_result($id, $nom,$nombre_produits);
        $categories = array();
        while ($stmt->fetch()) {
            $categories[] = ['id' => $id, 'nom' => $nom,'nombre_produits' => $nombre_produits];
        }
        $stmt->close();
        $response = ['success' => true, 'data' => $categories];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Modifier_Categ($category)
{
    global $connexion;
    $id = $category->getId();
    $nom = $category->getNom();

    $requette = "UPDATE categories SET nom = ? WHERE id = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("si", $nom, $id);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Mis à jour"];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Filtrer_Categs($search)
{
    global $connexion;
    $requete = "SELECT *
                FROM categories
                WHERE (nom LIKE ?)
                ORDER BY nom";

    try {
        $stmt = $connexion->prepare($requete);
        $searchParam = "%$search%";
        $stmt->bind_param("s", $searchParam);

        $stmt->execute();
        $stmt->bind_result($id, $nom);

        $categories = array();
        while ($stmt->fetch()) {
            $categories[] = ['id' => $id, 'nom' => $nom];
        }
        $stmt->close();
        $response = ['success' => true, 'data' => $categories];
    } catch (Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}
