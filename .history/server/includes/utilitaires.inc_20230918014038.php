<?php

function getProducts(){
    $liste=array();
    $liste[0]=1;
    $liste[1]=1;
    $liste[2]=1;
    $liste[3]=1;
    $liste[4]=1;
    $liste[5]=1;
    $liste[6]=1;
    $liste[7]=1;
    return $liste;
}

$des = 'Some quick example text to build on the card title and make up the bulk of the card\'s content content content content and make up the bulk of the card and make up the bulk of the card and make up the bulk of the card. ';


function getSubDescription($inputString) {
    if(strlen($inputString) <= 125){
        return $inputString;
    }
    $result = substr($inputString, 0, 125).' ...';
    return $result;      
}

function formatPrice($price) {
    return number_format($price, 2, '.', ' ');      
} 


function getHtmlProucut($product){
    $html = '<div class="col-md-4">';
    $html.= '<div class="card">';
    $html.= '<div class="card-body">';
    $html.= '<h5 class="card-title">'.$product['name'].'</h5>';
    $html.= '<p class="card-text">'.$product['description'].'</p>';
    $html.= '<p class="card-text"><small class="text-muted">Price: '.formatPrice($product['price']).'</small></p>';
    $html.= '<a href="#" class="btn btn-primary">Add to cart</a>';
    $html.= '</div>';
    $html.= '</div>';
    $html.= '</div>';
    return $html;

}

?>