<?php
    class Category{
        private $idc;
        private $nom;

        function __construct($idc,$nom) {
            $this->setId($idc);
            $this->setNom($nom);
        }
    

        public function setId($idc) {
            $this->idc = $idc;
        }
    
        public function getId() {
            return $this->idc;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }
    
        public function getNom() {
            return $this->nom;
        }

        function afficher(){
            $rep= $this->idc." ".$this->nom;
            return $rep;
        }
    }

    
    
?>