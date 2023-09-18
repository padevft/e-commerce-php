<?php

function getProducts()
{
    $liste = array();
    $liste[0] = 1;
    $liste[1] = 1;
    $liste[2] = 1;
    $liste[3] = 1;
    $liste[4] = 1;
    $liste[5] = 1;
    $liste[6] = 1;
    $liste[7] = 1;
    return $liste;
}

$des = 'Some quick example text to build on the card title and make up the bulk of the card\'s content content content content and make up the bulk of the card and make up the bulk of the card and make up the bulk of the card. ';


function getSubDescription($inputString)
{
    if (strlen($inputString) <= 125) {
        return $inputString;
    }
    $result = substr($inputString, 0, 125) . ' ...';
    return $result;
}

function formatPrice($price)
{
    return number_format($price, 2, '.', ' ');
}

function getURL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        // La connexion est sécurisée via HTTPS
        $protocole = 'https://';
    } else {
        // La connexion n'est pas sécurisée, utilisez HTTP
        $protocole = 'http://';
    }
    $url = $protocole . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
    return $url;
}


function getHtmlProucut($product)
{
    global $des;
    $html = <<<HTML
    <div class="card position-relative item-product">
        <img src="client/images/p-3.jpg" alt="...">
        <div class="card-body">
            <span class="card-title title-product">Card title</span>
    HTML;
    $html .= '<p class="card-text text-des">' . getSubDescription($des) . '</p>';
    $html .= '<div class="d-flex justify-content-center"><span class="text-price">$' . formatPrice(3000) . '</span></div>';
    $html .= <<<HTML
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
    HTML;

    return $html;
}
