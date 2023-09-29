<?php

    require_once('../bd/connexion.inc.php');
    function Mdl_Connexion($courriel, $mdp){
        global $connexion;
        $sqlSelectCourriel = "SELECT * FROM connexion WHERE courriel = ? AND pass=?";

        try{
            $stmt = $connexion->prepare($sqlSelectCourriel);
            $stmt->bind_param("ss", $courriel, $mdp);
            $stmt->execute();
            $reponse = $stmt->get_result();
            if($reponse->num_rows > 0){
                $ligne = $reponse->fetch_object();
                if($ligne->statut == 'A'){
                    $msg = $ligne->role;
                }else{
                    $msg = "SVP contactez l'administrateur  !!!";
                }
            }else{
                $msg =  "Impossible de se connecter  !!!";
            }
        }catch(Exception $e){
            $msg = "Erreur : ".$e->getMessage().'<br>';
        }finally{
            return $msg;
        }        
    }
?>