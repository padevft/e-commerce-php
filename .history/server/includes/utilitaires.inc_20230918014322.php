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
    
    
    
      
      
          </div>
    <div class="hover-product">
      <div class="options">
        <div class="icons-options">
          <a href="#" class="icon">
            <i class="fa fa-shopping-cart"></i>
          </a>
          <a href="#" class="icon">
            <i class="fa fa-eye"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
    $html = '<div class="card position-relative item-product">';
    $html.= '<img src="client/images/p-3.jpg" alt="...">';
    $html.= '<div class="card-body">';
    $html.= '<span class="card-title title-product">Card title</span>';
    $html.= '<p class="card-text text-des">'. getSubDescription($des).'</p>';
    $html.= '<div class="d-flex justify-content-center"><span class="text-price">$'.formatPrice(3000).'</span></div>
    ';
    $html.= '<a href="#" class="btn btn-primary">Add to cart</a>';
    $html.= '</div>';
    $html.= '</div>';
    $html.= '</div>';
    return $html;

}

?>