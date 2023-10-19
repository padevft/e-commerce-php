

var listeProduits = [];
var listeCategories = [];


/***
 * Fonction de charger des donnees
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
                loadCategoriesTab(listeCategories);
                setCategoriesSelect(listeCategories);
            } else {
                errorLoadCategs(
                    "Une erreur s'est produite lors du chargement des donnees"
                );
            }

            if (result?.produits) {
                listeProduits = result.produits;
                loadProduitsTab(listeProduits);
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
            console.log(response);
            var result = JSON.parse(response);
            if (result.success) {
                loadData();
                showSuccessMessageProduct(newProduct);
            } else {
                showErrorMessageProduct(newProduct, result.message);
            }
        },
        error: function (error) {
            showErrorMessageProduct(newProduct, error);
        },
    });
}

/***
 * Function Ajax d'ajout d'une categorie
 *
 */

function addCateg(nom) {
    var formData = new FormData();
    formData.append("title", nom);
    formData.set("action", "add-categ");

    $.ajax({
        type: "POST",
        url: "./../../server/admin/controleurAdmin.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                $("#title-categ").val("");
                //Affichage du message d'enregistrement reussi
                $(".success-add-categ")
                    .toggleClass("d-none d-flex")
                    .html("<b>Catégorie ajoutée</b>");

                //Interval de temps d'affiche du message alert de reuissite
                setTimeout(function () {
                    $(".success-add-categ").toggleClass("d-none d-flex");
                }, 3500);
            } else {
                //Affichage de l'erreur
                $(".error-add-categ").toggleClass("d-none d-flex").html(result.message);
                setTimeout(function () {
                    $(".error-add-categ").toggleClass("d-none d-flex");
                }, 3500);
            }
        },
        error: function (error) {
            console.log("Erreur AJAX : ", error);
            $(".error-add-categ").toggleClass("d-none d-flex").html(error);
            setTimeout(function () {
                $(".error-add-categ").toggleClass("d-none d-flex");
            }, 3500);
        },
    });
}
