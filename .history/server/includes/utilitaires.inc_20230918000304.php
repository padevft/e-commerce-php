<?php

function get_products(){
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

$des = 'Some quick example text to build on the card title and make up the bulk of the card\'s content.';


function get_sub_description($inputString) {
    if(strlen($inputString) == 150){
        return $inputString;
    }else{
        $result = substr($inputString, 0, 150).' ...';
        return $result;
    }    
}

   

?>