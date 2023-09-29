<?php

    require_once('../bd/connexion.inc.php');
    function Mdl_Ajouter($membre,$mdp){
        global $connexion;
        $nom = $membre->getNom();
        $prenom = $membre->getPrenom();
        $courriel = $membre->getCourriel();
        $sexe = $membre->getSexe();
        $daten = $membre->getDaten();

        $sqlInsertMembre = "INSERT INTO membres VALUES (0,?, ?, ?, ?, ?)";
        $sqlInsertConnexion = "INSERT INTO connexion VALUES (?,?, ?, 'M', 'A')";
        $sqlSelectMembre = "SELECT * FROM membres WHERE courriel = ?";
        try{

            //Tester si le couriel existe deja
            $stmt = $connexion->prepare($sqlSelectMembre);
            $stmt->bind_param("s", $courriel);
            $stmt->execute();
            $reponse = $stmt->get_result();

            if($reponse->num_rows == 0){              
                $stmt = $connexion->prepare($sqlInsertMembre);
                $stmt->bind_param("sssss",$nom, $prenom,$courriel,$sexe,$daten);
                $stmt->execute();
                $idm = $connexion->insert_id;

                $stmt = $connexion->prepare($sqlInsertConnexion);
                $stmt->bind_param("iss", $idm, $courriel, $mdp);
                $stmt->execute();
                $msg = "Compte crée";
            }else{
                $msg = "Ce courriel est déja utilisé";
            }

        }catch(Exception $e){
            $msg = "Erreur : ".$e->getMessage().'<br>';
        }finally{
            return $msg;
        }
        
    }
?>