function loadProductsA(produits) {
    let rep = "";
    var limit = produits?.length > 12 ? 12 : produits?.length;
    for (var i = 0; i < limit; i++) {
        rep += construireProduitA(produits[i]);
    }
    $(".h-products").html(rep);
}

$(function () {
    /***
     * Charger les donnees
     *
     */
    loadDataA();
});
