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
    $requete = "SELECT p.id, p.titre, p.prix, p.quantite, p.description, p.date_ajout, p.pochette, c.id AS categorie_id, c.nom AS categorie_nom 
                FROM produits p
                LEFT JOIN categories c ON p.categorie = c.id
                ORDER BY p.titre";

    try {
        $stmt = $connexion->prepare($requete);
        $stmt->execute();
        $stmt->bind_result($id, $titre, $prix, $quantite, $description, $date_ajout, $pochette, $categorie_id, $categorie_nom);

        $products = array();

        while ($stmt->fetch()) {
            $products[] = [
                'id' => $id,
                'titre' => $titre,
                'categorie_id' => $categorie_id,
                'categorie' => $categorie_nom,
                'prix' => $prix,
                'quantite' => $quantite,
                'description' => $description,
                'date_ajout' => $date_ajout,
                'pochette' => getURL() . "/server/admin/" . $pochette
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
                'pochette' => $pochette,
                'pochette_url' => getURL() . "/server/admin/" . $pochette
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
        $stmt->bind_param("siiisss", $titre, $categ, $prix, $quantite, $description, $date_ajout, $pochette);
        $stmt->execute();
        $idp = $connexion->insert_id;
        $response = ['success' => true, 'message' => 'Produit ajouté', "produits" => Mdl_Produits()];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
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
        $response = ['success' => true, 'message' => "Produit mis à jour","produits" => Mdl_Produits()];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Supprimer_Produit($id)
{
    global $connexion;

    $requette = "DELETE FROM produits WHERE id = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Produit supprimé","produits" => Mdl_Produits()];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}




function Mdl_Filtrer_Produits($category, $sort, $search)
{
    global $connexion;
    $orderByColumn = 'produits.titre'; // Par défaut
    switch ($sort) {
        case 'quantite':
            $orderByColumn = 'produits.quantite';
            break;
        case 'quantite_desc':
            $orderByColumn = 'produits.quantite DESC';
            break;
        case 'prix':
            $orderByColumn = 'produits.prix';
            break;
        case 'prix_desc':
            $orderByColumn = 'produits.prix DESC';
            break;
        case 'date_ajout':
            $orderByColumn = 'produits.date_ajout';
            break;
        case 'date_ajout_desc':
            $orderByColumn = 'produits.date_ajout DESC';
            break;
    }

    $requete = "SELECT produits.id, produits.titre, produits.prix, produits.quantite, produits.description, produits.date_ajout, produits.pochette, categories.id As categorie_id, categories.nom AS categorie_nom
                FROM produits
                INNER JOIN categories ON produits.categorie = categories.id
                WHERE
                    (produits.titre LIKE ? OR produits.description LIKE ?)
                    AND (categories.id = ? OR ? = 0)
                ORDER BY $orderByColumn";

    try {
        $stmt = $connexion->prepare($requete);
        $searchParam = "%$search%";
        $stmt->bind_param("ssis", $searchParam, $searchParam, $category, $category);

        $stmt->execute();
        $stmt->bind_result($id, $titre,  $prix, $quantite, $description, $date_ajout, $pochette, $categorie_id, $categorie_nom);

        $products = array();

        while ($stmt->fetch()) {
            $products[] = [
                'id' => $id,
                'titre' => $titre,
                'categorie_id' => $categorie_id,
                'categorie' => $categorie_nom,
                'prix' => $prix,
                'quantite' => $quantite,
                'description' => $description,
                'date_ajout' => $date_ajout,
                'pochette' => getURL() . "/server/admin/" . $pochette
            ];
        }

        $stmt->close();

        $response = ['success' => true, 'data' => $products];
    } catch (Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    } finally {
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
    $requette = "SELECT id, nom  FROM categories ORDER BY nom";

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
    } finally {
        return $response;
    }
}


function Mdl_Modifier_Categ($id, $nom)
{
    global $connexion;

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



/********************************************************************************************
 * 
 * 
 * --                                   SECTION MEMBRE
 * 
 * 
 *********************************************************************************************/
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

function Mdl_Modifier_Membre($id, $statut)
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

function Mdl_Filtrer_Membre($search)
{
    global $connexion;
    $requete = "SELECT m.idm, m.nom, m.prenom, m.courriel, m.sexe, m.datenaissance, c.statut AS status_membre 
                FROM membres m
                LEFT JOIN connexion c ON m.idm = c.idm
                WHERE m.nom LIKE ?
                ORDER BY m.nom";

    try {
        $stmt = $connexion->prepare($requete);
        $searchParam = "$search%";
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
