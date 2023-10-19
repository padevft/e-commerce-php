/***
 * Function pour afficher  les produits
 *
 */

function loadProduitsTab(produits) {
    if (produits.length > 0) {
        var lines = "";
        for (var i = 0; i < produits.length; i++) {
            var produit = produits[i];
            lines += `<div class="card card-item mb-3" style="max-width: 1200px;">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        <div class="d-flex justify-content-center align-itmes-center p-3">
                                            <img src="${produit.pochette}" class="img-fluid rounded" alt="Image">
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-12 col-md-9">
                                                    <h2 class="card-title"><b>${produit.titre}</b></h2>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="d-flex justify-content-end gap-3">
                                                        <i class="fa fa-trash btn btn-danger   delete-product" aria-hidden="true" data-id="${produit.id}"></i>
                                                        <i class="fa fa-pencil btn btn-primary edit-product" aria-hidden="true"  data-id="${produit.id}"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <span><b>Categorie : </b></span>
                                                <span class="text-primary"><b>${produit.categorie}</b></span>
                                            </div>
                                            <div class="d-md-flex gap-4 card-data1">
                                                <div class="d-flex gap-2">
                                                    <span><b>Quantite : </b></span>
                                                    <span class="text-info"><b>${produit.quantite}</b></span>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <span><b>Prix : </b></span>
                                                    <span class="text-success"><b>${produit.prix}$</b></span>
                                                </div>
                                            </div>
                                            <textarea class="form-control card-description py-2" rows="5" disabled="disabled">${produit.description}</textarea>
                                            <p class="d-flex gap-2 pt-4"><b>Ajouter le :</b> <b><span class="text-primary">${produit.date_ajout}</span></b></p>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        }
        $(".admin-products").html(lines);
        produitAction();
    } else {
        $(".admin-products").append(
            `<div class="d-flex justify-content-center"><b>Aucune categorie</b></div>`
        );
    }
}

/***
 * Function sur les buttons d'editer et suppression d'un produit
 *
 */

function produitAction() {
    $(".edit-product").each(function (index) {
        $(this).click(function () {
            var id = $(this).attr("data-id");
            let produit = listeProduits.find((produit) => {
                return produit["id"] == id;
            });
            if (produit) {
                showFormUpdateProduct();
                showFormDataUpdateProduct(produit);
            }
        });
    });
    $(".delete-product").each(function (index) {
        $(this).click(function () {
            var id = $(this).attr("data-id");
            let produit = listeProduits.find((produit) => {
                return produit["id"] == id;
            });
        });
    });
}

/***
 * Function pour afficher  les categories
 *
 */

function loadCategoriesTab(categories) {
    if (categories.length > 0) {
        var tr = "";
        for (var i = 0; i < categories.length; i++) {
            var categ = categories[i];
            tr += `<tr class='fw-semibold'>
                            <td> ${categ.id} </td>
                            <td> ${categ.nom} </td>
                            <td>
                                <div class="d-flex justify-content-end gap-3">
                                    <i class="fa fa-trash btn btn-danger   btn-enlever" aria-hidden="true"></i>
                                    <i class="fa fa-pencil btn btn-primary btn-editer" aria-hidden="true"></i>
                                </div>
                            </td>
                        </tr>`;
        }
        $(".list-categs").html(tr);
    } else {
        $(".list-categs").html(
            `<tr><div class="d-flex justify-content-center"><b>Aucune categorie</b></div></tr>`
        );
    }
}

/***
 * Fonction pour charger des les categories dans le select
 *
 */
const setCategoriesSelect = (categories) => {
    var options = `<option value=""></option>`;
    for (let c of categories) {
        options += `<option value="${c.id}">${c.nom}</option>`;
    }
    $(".category-admin").html(options);
};

/***
 * Erreur lors du chagement des produits
 *
 */

function errorLoadProducts(message) {
    $(".error-list-product").toggleClass("d-none d-flex").html(message);
}

/***
 * Erreur lors du chagement des categories
 *
 */

function errorLoadCategs(message) {
    $(".error-list-categ").toggleClass("d-none d-flex").html(message);
}

/**
 *
 * Montrer le formulaire d'enregistrement du produit
 */

function showFormProduct() {
    $(".admin-list").addClass("d-none").removeClass("d-flex");
    $(".admin-add").removeClass("d-none").addClass("d-flex");
    $(".success-add").addClass("d-none").removeClass("d-flex"); //Masquer le alert s'il est encore visible
    $(".error-add").addClass("d-none").removeClass("d-flex");
}


/**
 *
 * Montrer le formulaire d'enregistrement du produit
 */

function showFormCateg() {
    $(".admin-list-categ").addClass("d-none").removeClass("d-flex");
    $(".admin-add-categ").removeClass("d-none").addClass("d-flex");
    $(".success-categ").addClass("d-none").removeClass("d-flex"); //Masquer le alert s'il est encore visible
    $(".error-categ").addClass("d-none").removeClass("d-flex");
}

/**
 *
 * Fermer le formulaire d'enregistrement du produit
 */

function closeFormProduct() {
    $(".admin-list").removeClass("d-none").addClass("d-flex");
    $(".admin-add").removeClass("d-flex").addClass("d-none");
    cleanForm();
}

/**
 *
 * Montrer le formulaire de modification du produit
 */

function showFormUpdateProduct() {
    $(".admin-list").addClass("d-none").removeClass("d-flex");
    $(".admin-update").removeClass("d-none").addClass("d-flex");
    $(".success-update").addClass("d-none").removeClass("d-flex"); //Masquer le alert s'il est encore visible
    $(".error-update").addClass("d-none").removeClass("d-flex");
}

/**
 *
 * Fermer le formulaire de modification du produit
 */

function closeFormUpdateProduct() {
    $(".admin-list").removeClass("d-none").addClass("d-flex");
    $(".admin-update").removeClass("d-flex").addClass("d-none");
    $(".success-update").addClass("d-none").removeClass("d-flex"); //Masquer le alert s'il est encore visible
    $(".error-update").addClass("d-none").removeClass("d-flex");
}

/**
 *
 * Insertion des donnees du produit dans le formulaire de modification du produit
 */

function showFormDataUpdateProduct(product) {
    $("#title-update").val(product.titre);
    $("#quantity-update").val(product.quantite);
    $("#price-update").val(product.prix);
    $("#categ-update").val(product.categorie).trigger("change");
    $("#description-update").val(product.description);
    $(".product-img").attr("src", product.pochette);
    actionButtonUpdateProduct(product);
}

/***
 * Nettoyage du formulaire d'ajout du produit
 *
 */

function cleanForm() {
    $("#title").val("");
    $("#quantity").val("");
    $("#price").val("");
    $("#categ-add").val("").trigger("change");
    $("#description").val("");
    $("#img-product").val("");
}

/***
 * verification de tous les champs du formulaire d'ajout d'un produit
 *
 */

function checkFormFields(title, quantity, price, categ, description, image) {
    if (title && quantity && price && categ && description && image) {
        return true;
    }
    return false;
}

/***
 * Action sur le button enregistrer pour modifier un produit
 *
 */

function actionButtonUpdateProduct(product) {
    $(".btn-update-product").on("click", function () {
        var title = $("#title-update").val();
        var quantity = $("#quantity-update").val();
        var price = $("#price-update").val();
        var category = $("#categ-update").val();
        var description = $("#description-update").val();
        var image = $("#img-product-update")[0].files[0];
        var image = image ? image : "1";

        if (checkFormFields(title, quantity, price, category, description, image)) {
            manageProduct(
                product.id,
                title,
                quantity,
                price,
                category,
                description,
                image,
                false
            );
        } else {
            showErrorMessageProduct(false, "<b>Tous les champs sont requis</b>");
        }
    });
}

/***
 * Funtion de reussite lors de la creation ou la modification du produit
 *
 */

function showSuccessMessageProduct(newProduct) {
    if (newProduct) {
        cleanForm();
        //Affichage du message d'enregistrement reussi
        $(".success-add")
            .toggleClass("d-none d-flex")
            .html("<b>Produit Ajoute</b>");

        //Interval de temps d'affiche du message alert de reuissite
        setTimeout(function () {
            $(".success-add").toggleClass("d-none d-flex");
        }, 3500);
    } else {
        closeFormUpdateProduct();
    }
}

/***
 * Funtion de l'echec lors de la creation ou la modification du produit
 *
 */

function showErrorMessageProduct(newProduct, message) {
    if (newProduct) {
        //Affichage de l'erreur
        $(".error-add").toggleClass("d-none d-flex").html(message);
        setTimeout(function () {
            $(".error-add").toggleClass("d-none d-flex");
        }, 3500);
    } else {
        $(".error-update").toggleClass("d-none d-flex").html(message);
        setTimeout(function () {
            $(".error-update").toggleClass("d-none d-flex");
        }, 3500);
    }
}

$(function () {
    /***
     * Charger les donnees
     *
     */
    loadData();

    /**
     *
     * Customization des select
     */

    $(".category-admin").select2({
        placeholder: "Selectionner",
        // allowClear: true,
        theme: "bootstrap-5",
        // tags: true,
    });
    $(".sort-admin").select2({
        placeholder: "Selectionner",
        theme: "bootstrap-5",
    });

    /**
     *
     * Click sur le button ajouter pour afficher le formulaire d'ajout d'un produit
     */

    $("#add-product").on("click", function () {
        showFormProduct();
    });

    /**
     *
     * Click sur le button ajouter pour afficher le formulaire d'ajout d'une categorie
     */

    $("#add-categ").on("click", function () {
        showFormCateg();
    });

    /***
     *
     * Fermer le formulaire d'ajout d'un produit
     */
    $(".close-form-add-product,.btn-cancel").on("click", function () {
        closeFormProduct();
    });

    /***
     *
     * Fermer le formulaire de modification d'un produit
     */
    $(".close-form-update-product,.btn-cancel-update").on("click", function () {
        closeFormUpdateProduct();
    });

    /***
     *
     * Fermer le formulaire d'ajout d'une categorie
     */
    $(".close-form-add-categ,.btn-cancel-categ").on("click", function () {
        $(".admin-list-categ").toggleClass("d-none d-flex");
        $(".admin-add-categ").toggleClass("d-flex d-none");
    });

    /***
     * Action sur le button pour creer un produit
     *
     */
    $(".btn-save").on("click", function () {
        var title = $("#title").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var category = $("#categ-add").val();
        var description = $("#description").val();
        var image = $("#img-product")[0].files[0];

        if (checkFormFields(title, quantity, price, category, description, image)) {
            manageProduct(
                0,
                title,
                quantity,
                price,
                category,
                description,
                image,
                true
            );
        } else {
            showErrorMessageProduct(true, "<b>Tous les champs sont requis</b>");
        }
    });

    /***
     * Action sur le button pour creer une categorie
     *
     */
    $(".btn-save-categ").on("click", function () {
        var title = $("#title-categ").val();

        if (title) {
            addCateg(title);
        } else {
            $(".error-add-categ")
                .toggleClass("d-none d-flex")
                .html("<b>Nom requis</b>");
            setTimeout(function () {
                $(".error-add-categ").toggleClass("d-none d-flex");
            }, 3000);
        }
    });
});
