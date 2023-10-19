<?php

require_once('../bd/connexion.inc.php');
require_once('../includes/utilitaires.inc.php');


/********************************************************************************************
 * 
 * 
 * --                                   SECTION PRODUIT
 * 
 * 
 *********************************************************************************************/

 function Mdl_Produits()
 {
     global $connexion;
     $requete = "SELECT * FROM produits";
 
     try {
         $stmt = $connexion->prepare($requete);
         $stmt->execute();
         $stmt->bind_result($id, $titre, $categorie, $prix, $quantite, $description, $date_ajout, $pochette);
         $products = array();
         
         while ($stmt->fetch()) {
             $products[] = [
                 'id' => $id,
                 'titre' => $titre,
                 'categorie' => $categorie,
                 'prix' => $prix,
                 'quantite' => $quantite,
                 'description' => $description,
                 'date_ajout' => $date_ajout,
                 'pochette' => getURL()."/server/admin/".$pochette
             ];
         }
         
         $stmt->close();
         
         $response = ['success' => true, 'data' => $products];
     } catch (Exception $e) {
         $response = ['success' => false, 'message' => $e->getMessage()];
     } finally {
         return $response;
     } 
 }

 function Mdl_Produit_Par_ID($id)
 {
     global $connexion;
     $requete = "SELECT * FROM produits WHERE id = ?";
 
     try {
         $stmt = $connexion->prepare($requete);
         $stmt->bind_param("i", $id);
         $stmt->execute();
         $stmt->bind_result($id, $titre, $categorie, $prix, $quantite, $description, $date_ajout, $pochette);
         $products = array();
         
         while ($stmt->fetch()) {
             $products[] = [
                 'id' => $id,
                 'titre' => $titre,
                 'categorie' => $categorie,
                 'prix' => $prix,
                 'quantite' => $quantite,
                 'description' => $description,
                 'date_ajout' => $date_ajout,
                 'pochette' => getURL()."/server/admin/".$pochette
             ];
         }
         
         $stmt->close();
         
         $response = ['success' => true, 'data' => $products];
     } catch (Exception $e) {
         $response = ['success' => false, 'message' => $e->getMessage()];
     } finally {
         return $response;
     } 
 }
 



 function Mdl_Ajouter_Produit($produit)
{
    global $connexion;
    $titre = $produit->getTitre();
    $categ = $produit->getCateg();
    $prix = $produit->getPrix();
    $quantite = $produit->getQuantite();
    $description = $produit->getDescription();
    $pochette = $produit->getImage();
    $date_ajout = $produit->getDateAjout();

    $requette = "INSERT INTO produits (titre, categorie, prix, quantite, `description`, date_ajout, pochette) VALUES (?, ?, ?, ?, ?, ?,?)";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("siiisss", $titre, $categ, $prix, $quantite, $description,$date_ajout,$pochette);
        $stmt->execute();
        $idp = $connexion->insert_id;
        $response = ['success' => true, 'message' => $idp];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    }finally{
        return $response;
    } 
}



function Mdl_Modifier_Produit($produit)
{
    global $connexion;
    $id = $produit->getId();
    $titre = $produit->getTitre();
    $categ = $produit->getCateg();
    $prix = $produit->getPrix();
    $quantite = $produit->getQuantite();
    $description = $produit->getDescription();
    $pochette = $produit->getImage();

    $requette = "UPDATE produits SET titre = ?, categorie = ?, prix = ?, quantite = ?, `description` = ?, pochette = ? WHERE id = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("siiissi", $titre, $categ, $prix, $quantite, $description, $pochette, $id);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Produit mis a jour"];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    }finally{
        return $response;
    } 
}











/********************************************************************************************
 * 
 * 
 * --                                   SECTION CATEGORIE
 * 
 * 
 *********************************************************************************************/
function Mdl_Ajouter_Categ($nom)
{
    global $connexion;
    $requette = "INSERT INTO categories (nom) VALUES (?)";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $idp = $connexion->insert_id;
        $response = ['success' => true, 'message' => $idp];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    }finally{
        return $response;
    } 
}
function Mdl_Categs()
{
    global $connexion;
    $requette = "SELECT id, nom  FROM categories";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->execute();
        $stmt->bind_result($id, $nom);
        $categories = array();
        while ($stmt->fetch()) {
            $categories[] = ['id' => $id, 'nom' => $nom];
        }
        $stmt->close();
        $response = ['success' => true, 'data' => $categories];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    }finally{
        return $response;
    } 
}
