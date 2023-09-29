<?php
    class Membre{
        private $idm;
        private $nom;
        private $prenom;
        private $courriel;
        private $sexe;
        private $daten;

        function __construct($idm,$nom, $prenom, $courriel, $sexe, $daten) {
            $this->setNom($idm);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setCourriel($courriel);
            $this->setSexe($sexe);
            $this->setDaten($daten);
        }
    

        public function setIdm($idm) {
            $this->idm = $idm;
        }
    
        public function getIdm() {
            return $this->idm;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }
    
        public function getNom() {
            return $this->nom;
        }
    
        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }
    
        public function getPrenom() {
            return $this->prenom;
        }
    
        public function setCourriel($courriel) {
            $this->courriel = $courriel;
        }
    
        public function getCourriel() {
            return $this->courriel;
        }
    
        public function setSexe($sexe) {
            $this->sexe = $sexe;
        }
    
        public function getSexe() {
            return $this->sexe;
        }
    
        public function setDaten($daten) {
            $this->daten = $daten;
        }
    
        public function getDaten() {
            return $this->daten;
        }


        function afficher(){
            $rep= $this->idm." ".$this->nom." ".$this->prenom." ".$this->courriel." ";
            if($this->sexe == 'F'){
                $sexe = 'Feminin';
            }else{
                $sexe = 'Masculin';
            }
            $rep .= $sexe." ".$this->daten;

            return $rep;
        }
    }

    
    
?>