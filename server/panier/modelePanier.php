<?php

require_once('../bd/connexion.inc.php');
require_once('../includes/utilitaires.inc.php');


/********************************************************************************************
 * 
 * 
 * --                                   SECTION PRODUIT PANIER
 * 
 * 
 *********************************************************************************************/

function Mdl_Produits_Panier($idm)
{
    global $connexion;
    $requete = "SELECT pa.idm, pa.idp, pa.quantite, pa.date_ajout AS date_ajout_panier,
                 pr.id, pr.titre, pr.prix, pr.quantite AS quantite_produit, pr.description, pr.date_ajout AS date_ajout_produit, pr.pochette,
                 ca.id AS categorie_id, ca.nom AS categorie_nom 
                 FROM panier pa
                 LEFT JOIN produits pr ON pa.idp = pr.id
                 LEFT JOIN categories ca ON pr.categorie = ca.id
                 WHERE pa.idm = ?
                 ORDER BY pr.titre";

    try {
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("i", $idm);
        $stmt->execute();
        $stmt->bind_result(
            $idm_result,
            $idp,
            $quantite_panier,
            $date_ajout_panier,
            $id_produit,
            $titre,
            $prix,
            $quantite_produit,
            $description,
            $date_ajout_produit,
            $pochette,
            $categorie_id,
            $categorie_nom
        );

        $productsInCart = array();
        $montantTotalPanier = 0;


        while ($stmt->fetch()) {
            $montantProduit = $prix * $quantite_panier;
            $montantTotalPanier += $montantProduit;
            $productsInCart[] = [
                'idm' => $idm_result,
                'idp' => $idp,
                'quantite_panier' => $quantite_panier,
                'date_ajout_panier' => $date_ajout_panier,
                'id_produit' => $id_produit,
                'titre' => $titre,
                'categorie_id' => $categorie_id,
                'categorie' => $categorie_nom,
                'prix' => $prix,
                'quantite_produit' => $quantite_produit,
                'description' => $description,
                'date_ajout_produit' => $date_ajout_produit,
                'pochette' => getURL() . "/server/product/" . $pochette,
                'montantProduit' => $montantProduit,
                'montantTotalPanier' => $montantTotalPanier,
            ];
        }

        $stmt->close();
        // $_SESSION['idm'] = $idm;
        $response = ['success' => true, 'data' => $productsInCart];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Ajouter_Produit_Panier($panier)
{
    global $connexion;
    $idm = $panier->getIdm();
    $idp = $panier->getIdp();
    $quantite = $panier->getQuantite();
    $date_ajout = $panier->getDateAjout();

    $requette = "INSERT INTO panier (idm, idp, quantite, date_ajout) VALUES (?, ?, ?, ?)";

    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("iiis", $idm, $idp, $quantite, $date_ajout);
        $stmt->execute();
        $idp = $connexion->insert_id;
        $response = ['success' => true, 'message' => 'Produit ajouté au panier', "produits" => Mdl_Produits_Panier($idm)];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}



function Mdl_Modifier_Produit_Panier($panier)
{
    global $connexion;
    $idm = $panier->getIdm();
    $idp = $panier->getIdp();
    $quantite = $panier->getQuantite();
    $date_ajout = $panier->getDateAjout();

    $requette = "UPDATE panier SET quantite = ?, date_ajout = ? WHERE idm = ? AND idp = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("isii", $quantite, $date_ajout, $idm, $idp);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Mise à jour", "produits" => Mdl_Produits_Panier($idm)];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Supprimer_Produit_Panier($panier)
{
    global $connexion;
    $idm = $panier->getIdm();
    $idp = $panier->getIdp();

    $requette = "DELETE FROM panier WHERE idm = ? AND idp = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("ii", $idm, $idp);
        $stmt->execute();
        $response = ['success' => true, 'message' => "Produit supprimé", "produits" => Mdl_Produits_Panier($idm)];
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}


function Mdl_Produit_Panier_Par($panier)
{
    global $connexion;
    $idm = $panier->getIdm();
    $idp = $panier->getIdp();

    $requette = "SELECT * FROM panier WHERE idm = ? AND idp = ?";
    try {
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("ii", $idm, $idp);
        $stmt->execute();
        $reponse = $stmt->get_result();
        if ($reponse->num_rows > 0) {
            $ligne = $reponse->fetch_object();
            $response = ['success' => true, 'message' => "1", 'quantite' => $ligne->quantite];
        } else {
            $response = ['success' => true, 'message' => "0"];
        }
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => $e->getMessage()];
    } finally {
        return $response;
    }
}
// Produit non trouvé