<?php
$file_path = getURL() . '/server/data/data.json';
// Lire le contenu du fichier JSON
$json_data = file_get_contents($file_path);
// Décoder le contenu JSON en une structure de données PHP (tableau associatif)
$data = json_decode($json_data, true);
function getProducts()
{
    global $data;

    return $data['products'];
}

function getProductCategories()
{
    global $data;

    return $data['categories'];
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
    $url = $protocole . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/shop-online';
    return $url;
}

function calculerMontantPanier($panier)
{
    $montantTotal = 0;

    foreach ($panier as $produit) {
        $montantTotal += $produit['prix'] * $produit['quantite_panier'];
    }

    return $montantTotal;
}


function getHtmlProucutCategory($categ)
{
    $html = '<div class="d-flex align-items-center justify-content-between item-categ" data-id="' . $categ['id'] . '" data-nom="' . $categ['nom'] . '">';
    $html .= '<span class="text-categ-item">' . $categ['nom'] . '</span>';
    $html .= '<span class="number-categ-item">(' . $categ['nombre_produits'] . ')</span>';
    $html .= '</div>';

    return $html;
}



function getHtmlProucut($product)
{
    $html = <<<HTML
    <div class="card position-relative item-product">
    HTML;
    $html .= '<img class="object-fit-cover" src="' . $product['pochette'] . '" alt="...">';
    $html .= '<div class="card-body">
            <span class="card-title title-product">' . $product['titre'] . '</span>';
    $html .= '<p class="card-text text-des">' . getSubDescription($product['description']) . '</p>';
    $html .= '<div class="d-flex justify-content-center"><span class="text-price">' . formatPrice($product['prix']) . '$</span></div>';
    $html .= '
        </div>
        <div class="hover-product">
            <div class="options">
                <div class="icons-options">
                    <a href="#" class="icon add-product-cart" data-product-id="' . $product['id'] . '">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <a href="#" class="icon">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>';

    return $html;
}

function getHtmlProucutPanier($product)
{
    $html = <<<HTML
    <tr>
    HTML;
    $html .= '<td>
                    <div class="d-flex justify-content-center align-itmes-center">
                        <img src="' . $product['pochette'] . '" class="img-cart" alt="Image">
                    </div>
             </td>';
    $html .= '<td>'. $product['titre'] . '</td>';
    $html .= '<td>'. $product['prix'] . ' $</td>';    
    $html .= '<td> <input type="number" class="form-control fw-semibold input-login quantite-panier" min="1" value="'. $product['quantite_panier'] . '" data-product-id="'. $product['id_produit'] . '" /></td>';
    $html .= '<td class="total-cart-item">'. $product['montantProduit'] . ' $</td>';
    $html .= '<td> <i class="fa fa-trash btn btn-danger delete-product-cart" aria-hidden="true" data-product-id="'. $product['id_produit'] . '"></i></td>';
    $html .= ' </tr>';

    return $html;
}
