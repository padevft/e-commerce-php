<?php
    class Produit{
        private $idp;
        private $titre;
        private $categ;
        private $prix;
        private $quantite;
        private $description;
        private $date_ajout;
        private $image;

        function __construct($idp,$titre, $categ, $prix, $quantite, $description,$date_ajout,$image) {
            $this->setId($idp);
            $this->setTitre($titre);
            $this->setCateg($categ);
            $this->setPrix($prix);
            $this->setQuantite($quantite);
            $this->setDescription($description);
            $this->setDateAjout($date_ajout);
            $this->setImage($image);
        }
    

        public function setId($idp) {
            $this->idp = $idp;
        }
    
        public function getId() {
            return $this->idp;
        }

        public function setTitre($titre) {
            $this->titre = $titre;
        }
    
        public function getTitre() {
            return $this->titre;
        }
    
        public function setCateg($categ) {
            $this->categ = $categ;
        }
    
        public function getCateg() {
            return $this->categ;
        }
    
        public function setPrix($prix) {
            $this->prix = $prix;
        }
    
        public function getPrix() {
            return $this->prix;
        }
    
        public function setQuantite($quantite) {
            $this->quantite = $quantite;
        }
    
        public function getQuantite() {
            return $this->quantite;
        }
    
        public function setDescription($description) {
            $this->description = $description;
        }
    
        public function getDescription() {
            return $this->description;
        }

        public function setDateAjout($date_ajout) {
            $this->date_ajout = $date_ajout;
        }
    
        public function getDateAjout() {
            return $this->date_ajout;
        }
        public function setImage($image) {
            $this->image = $image;
        }
    
        public function getImage() {
            return $this->image;
        }


        function afficher(){
            $rep= $this->idp." ".$this->titre." ".$this->categ." ".$this->prix." ".$this->description;
            return $rep;
        }
    }

    
    
?>