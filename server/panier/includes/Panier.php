<?php
    class Panier{
        private $idm;
        private $idp;
        private $quantite;
        private $date_ajout;

        function __construct($idm,$idp,$quantite, $date_ajout) {
            $this->setIdm($idm);
            $this->setIdp($idp);
            $this->setQuantite($quantite);
            $this->setDateAjout($date_ajout);
        }
    

        public function setIdm($idm) {
            $this->idm = $idm;
        }
    
        public function getIdm() {
            return $this->idm;
        }       

        public function setIdp($idp) {
            $this->idp = $idp;
        }
    
        public function getIdp() {
            return $this->idp;
        }

    
        public function setQuantite($quantite) {
            $this->quantite = $quantite;
        }
    
        public function getQuantite() {
            return $this->quantite;
        }       

        public function setDateAjout($date_ajout) {
            $this->date_ajout = $date_ajout;
        }
    
        public function getDateAjout() {
            return $this->date_ajout;
        }
    

        function afficher(){
            $rep= $this->idm." ".$this->idp." ".$this->quantite." ".$this->date_ajout." ";
            return $rep;
        }
    }
