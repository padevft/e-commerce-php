function getSubDescription(inputString) {
    if (inputString.length <= 125) {
        return inputString;
    }
    const result = inputString.slice(0, 125) + " ...";
    return result;
}

function formatPrice(price) {
    // Séparation des parties entières et décimales
    const parts = price.toString().split(".");
    let formattedPrice = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    
    // Si des décimales existent, ajoutez-les avec un point
    if (parts.length > 1) {
        formattedPrice += "." + parts[1];
    }    
    return formattedPrice;
}

/***
 * Fonction pour construire un produit sur l'accueil
 *
 */

function construireProduitA(produit) {
    var line = ` <div class="swiper-slide">
                    <div class="card position-relative item-product">
                        <img class="object-fit-cover" src="${produit.pochette
        }" alt="...">
                        <div class="card-body">
                            <span class="card-title title-product">${produit.titre
        }</span>
                            <p class="card-text text-des">${getSubDescription(
            produit.description
        )} </p>
                            <div class="d-flex justify-content-center"><span class="text-price"> ${formatPrice(
            produit.prix
        )} $</span></div>
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
                </div>`;
    return line;
}
