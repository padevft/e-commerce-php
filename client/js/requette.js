var listeProduitsA = [];
var listeProduits = [];
var listeCategories = [];
var listeMembres = [];
var product = null;
var categ = null;

/***
 * Fonction de charger des donnees sur la page Accueil
 *
 */
function loadDataA() {
    $.ajax({
        type: "POST",
        url: "./server/admin/controleurAdmin.php",
        data: { action: "list" },
        success: function (response) {
            // console.log(response);
            var result = JSON.parse(response);
            if (result?.produits) {
                listeProduitsA = result.produits;
                loadProductsA(listeProduitsA);
            } else {
                console.log("Une erreur s'est produite lors du chargement des donnees");
            }
        },
        error: function () {
            console.log("Une erreur s'est produite lors du chargement des donnees");
        },
    });
}

/***
 * Fonction de charger des donnees sur la page Admin
 *
 */
function loadData() {
    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: { action: "list" },
        success: function (response) {
            console.log(response);
            var result = JSON.parse(response);
            if (result?.categories) {
                listeCategories = result.categories;
                loadCategs(listeCategories);
                setCategsSelect(listeCategories);
                setCategsSelectForm(listeCategories);
            } else {
                errorLoadCategs(
                    "Une erreur s'est produite lors du chargement des donnees"
                );
            }

            if (result?.produits) {
                listeProduits = result.produits;
                loadProducts(listeProduits);
            } else {
                errorLoadProducts(
                    "Une erreur s'est produite lors du chargement des donnees"
                );
            }

            if (result?.membres) {
                listeMembres = result.membres;
                loadMembres(listeMembres);
            } else {
                errorLoadProducts(
                    "Une erreur s'est produite lors du chargement des donnees"
                );
            }
        },
        error: function () {
            errorLoadProducts(
                "Une erreur s'est produite lors du chargement des donnees"
            );
            errorLoadCategs(
                "Une erreur s'est produite lors du chargement des donnees"
            );
        },
    });
}

/***
 * Function d'ajout d'un produit
 *
 */

function manageProduct(
    id,
    title,
    quantity,
    price,
    category,
    description,
    image,
    newProduct
) {
    var formData = new FormData();
    formData.append("id", id);
    formData.append("title", title);
    formData.append("quantity", quantity);
    formData.append("price", price);
    formData.append("category", category);
    formData.append("description", description);
    formData.append("img-product", image);
    formData.set("action", newProduct ? "add-product" : "update-product");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                listeProduits = result.produits.data;
                loadProducts(listeProduits);
                showSuccessProduct(newProduct, result.message);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            showError(error);
        },
    });
}

/***
 * Function de suppression d'un produit
 *
 */
function deleteProduct(id) {
    var formData = new FormData();
    formData.append("id", id);
    formData.set("action", "delete-product");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                listeProduits = result.produits.data;
                loadProducts(listeProduits);
                showMessageDeleteProduct(true, result.message);
            } else {
                showMessageDeleteProduct(false, result.message);
            }
        },
        error: function (error) {
            showMessageDeleteProduct(false, error);
        },
    });
}

/***
 * Function de filtrage, recherche
 *
 */
function filterProduct() {
    var category = $("#categ-product").val();
    var sort = $("#sort-admin").val();
    var search = $("#search-products").val();

    var formData = new FormData();
    formData.append("category", category);
    formData.append("sort", sort);
    formData.append("search", search);
    formData.set("action", "filter-product");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log(response);
            var result = JSON.parse(response);
            if (result.success) {
                listeProduits = result.data;
                loadProducts(listeProduits);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            showError(error);
        },
    });
}

/***
 * Function Ajax d'ajout d'une categorie
 *
 */

function manageCateg(id, nom, newCateg) {
    var formData = new FormData();
    formData.append("id", id);
    formData.append("nom", nom);
    formData.set("action", newCateg ? "add-categ" : "update-categ");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                loadData();
                showSuccessCateg(newCateg, result.message);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            console.log("Erreur AJAX : ", error);
            showError(error);
        },
    });
}

/***
 * Function de filtrage, recherche categ
 *
 */
function filterCateg() {
    var search = $("#search-categs").val();

    var formData = new FormData();
    formData.append("search", search);
    formData.set("action", "filter-categ");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log(response);
            var result = JSON.parse(response);
            if (result.success) {
                loadCategs(result.data);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            showError(error);
        },
    });
}

function manageMembre(idm, statut) {
    var formData = new FormData();
    formData.append("id", idm);
    formData.append("statut", statut);
    formData.set("action", "update-membre");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // console.log(response);
            var result = JSON.parse(response);
            if (result.success) {
                listeMembres = result.membres.data;
                loadMembres(listeMembres);
                showSuccessMembre(result.message);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            showError(error);
        },
    });
}

/***
 * Function de filtrage, recherche Membre
 *
 */
function filterMembre() {
    var search = $("#search-membres").val();

    var formData = new FormData();
    formData.append("search", search);
    formData.set("action", "filter-membre");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var result = JSON.parse(response);
            if (result.success) {
                listeMembres = result.data;
                loadMembres(listeMembres);
            } else {
                showError(result.message);
            }
        },
        error: function (error) {
            showError(error);
        },
    });
}
