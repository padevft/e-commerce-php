var liveToast = document.getElementById("liveToast");
var toast = new bootstrap.Toast(liveToast);

/***
 * Fonction pour construire un produit
 *
 */

function construireProduit(produit) {
    var line = `<div class="card card-item mb-3" style="max-width: 1200px;">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <div class="d-flex justify-content-center align-itmes-center p-3">
                                <img src="${produit.pochette}" class="img-fluid" alt="Image">
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
                                <textarea class="form-control card-description my-2 py-2 bg-white" rows="5" disabled="disabled">${produit.description}</textarea>
                                <p class="d-flex gap-2 pt-2"><b>Ajouter le :</b> <b><span class="text-primary">${produit.date_ajout}</span></b></p>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>`;
    return line;
}

/***
 * Fonction pour construire un produit
 *
 */

function construireCateg(categ) {
    var line = `<tr class='fw-semibold'>
                    <td> ${categ.id} </td>
                    <td> ${categ.nom} </td>
                    <td>
                        <div class="d-flex justify-content-end gap-3">
                            <!--<i class="fa fa-trash btn btn-danger   btn-delete-categ" aria-hidden="true"></i>-->
                            <i class="fa fa-pencil btn btn-primary btn-edit-categ" aria-hidden="true" data-id=${categ.id}></i>
                        </div>
                    </td>
                </tr>`;
    return line;
}

/***
 * Fonction pour construire un membre
 *
 */

function construireMembre(membre) {
    var isActif = membre.statut === "A";
    var line = `<tr class='fw-semibold'>
                    <td> ${membre.id} </td>
                    <td> ${membre.nom} </td>
                    <td> ${membre.prenom} </td>
                    <td> ${membre.courriel} </td>
                    <td> ${membre.sexe} </td>
                    <td> ${membre.datenaissance} </td>
                    <td>
                        <div class="d-flex justify-content-end gap-3">
                            ${isActif
            ? `<i class="btn btn-danger btn-deactive-membre" aria-hidden="true" data-id=${membre.id}>Deactiver</i>`
            : ` <i class="btn btn-primary   btn-active-membre" aria-hidden="true" data-id=${membre.id}>Activer</i>`
        }                           
                            
                        </div>
                    </td>
                </tr>`;
    return line;
}

function getProduct(id) {
    let product = listeProduits.find((product) => {
        return product.id == id;
    });  
    return product;
}
function getCateg(id) {
    let categ = listeCategories.find((categ) => {
        return categ.id == id;
    });
    return categ;
}

function getMembre(id) {
    let membre = listeMembres.find((m) => {
        return m.id == id;
    });
    return membre;
}

/***
 * Fonction sur les buttons d'editer et suppression d'un produit
 *
 */
function produitAction() {
    $(".edit-product").each(function (index) {
        $(this).click(function () {
            product = getProduct($(this).attr("data-id"));
            if (product) {
                showFormUpdateProduct();
                showFormDataUpdateProduct();
            }
        });
    });
    $(".delete-product").each(function (index) {
        $(this).click(function () {
            product = getProduct($(this).attr("data-id"));
            if (product) {
                showModalDeleProduct();
            }
        });
    });
}

/***
 * Fonction sur les buttons d'editer et suppression d'un produit
 *
 */
function categAction() {
    $(".btn-edit-categ").each(function (index) {
        $(this).click(function () {
            categ = getCateg($(this).attr("data-id"));
            if (categ) {
                showFormUpdateCateg();
                showFormDataUpdateCateg();
            }
        });
    });
}

/***
 * Fonction sur les buttons d'editer et suppression d'un produit
 *
 */
function membreAction() {
    $(".btn-active-membre").each(function (index) {
        $(this).click(function () {
            manageMembre($(this).attr("data-id"), "A");
        });
    });
    $(".btn-deactive-membre").each(function (index) {
        $(this).click(function () {
            manageMembre($(this).attr("data-id"), "I");
        });
    });
}

/***
 * Fonction pour charger des les categories dans le select
 *
 */
function setCategsSelect(categories) {
    var options = `<option value="0">Confondues</option>`;
    for (let c of categories) {
        options += `<option value="${c.id}">${c.nom}</option>`;
    }
    $("#categ-product").html(options);
}

function setCategsSelectForm(categories) {
    var options = `<option value=""></option>`;
    for (let c of categories) {
        options += `<option value="${c.id}">${c.nom}</option>`;
    }
    $(".category-form-admin").html(options);
}

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
}

/**
 *
 * Montrer le formulaire d'enregistrement du produit
 */

function showFormCateg() {
    $(".admin-list-categ").addClass("d-none").removeClass("d-flex");
    $(".admin-add-categ").removeClass("d-none").addClass("d-flex");
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
 * Fermer le formulaire d'enregistrement du produit
 */

function closeFormCateg() {
    $(".admin-list-categ").removeClass("d-none").addClass("d-flex");
    $(".admin-add-categ").removeClass("d-flex").addClass("d-none");
    cleanForm();
}

/**
 *
 * Montrer le formulaire de modification du produit
 */

function showFormUpdateProduct() {
    $(".admin-list").addClass("d-none").removeClass("d-flex");
    $(".admin-update").removeClass("d-none").addClass("d-flex");
}

/**
 *
 * Montrer le formulaire de modification d'une categorie
 */

function showFormUpdateCateg() {
    $(".admin-list-categ").addClass("d-none").removeClass("d-flex");
    $(".admin-update-categ").removeClass("d-none").addClass("d-flex");
}

/**
 *
 * Fermer le formulaire de modification du produit
 */

function closeFormUpdateProduct() {
    $(".admin-list").removeClass("d-none").addClass("d-flex");
    $(".admin-update").removeClass("d-flex").addClass("d-none");
}

/**
 *
 * Fermer le formulaire de modification du produit
 */

function closeFormUpdateCateg() {
    $(".admin-list-categ").removeClass("d-none").addClass("d-flex");
    $(".admin-update-categ").removeClass("d-flex").addClass("d-none");
}

/**
 *
 * Insertion des donnees du produit dans le formulaire de modification du produit
 */

function showFormDataUpdateProduct() {
    $("#title-update").val(product?.titre);
    $("#quantity-update").val(product?.quantite);
    $("#price-update").val(product?.prix);
    $("#categ-update").val(product?.categorie_id).trigger("change");
    $("#description-update").val(product?.description);
    $("#img-product-update").val("");
    $(".product-img").attr("src", product?.pochette);
}

/**
 *
 * Insertion des donnees de la categorie dans le formulaire de modification du produit
 */

function showFormDataUpdateCateg() {
    $("#title-categ-update").val(categ?.nom);
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

function checkDataForm(title, quantity, price, categ, description, image) {
    if (title && quantity && price && categ && description && image) {
        return true;
    }
    return false;
}

/***
 * Fonction de reussite lors de la creation ou la modification du produit
 *
 */

function showSuccessProduct(newProduct, message) {
    $("#title-categ").val("");
    toast.show();
    $(".text-toast").addClass("alert-success").removeClass("alert-danger");
    $(".text-toast").html(message);
    if (newProduct) {
        cleanForm();
    } else {
        closeFormUpdateProduct();
    }
}

/***
 * Fonction de reussite lors de la creation ou la modification d'une categorie
 *
 */

function showSuccessCateg(newCateg, message) {
    toast.show();
    $(".text-toast").addClass("alert-success").removeClass("alert-danger");
    $("#title-categ").val("");
    $(".text-toast").html(message);
    if (!newCateg) {
        closeFormUpdateCateg();
    }
}

/***
 * Fonction de reussite lors de la creation ou la modification d'une categorie
 *
 */

function showSuccessMembre(message) {
    toast.show();
    $(".text-toast").addClass("alert-success").removeClass("alert-danger");
    $("#title-categ").val("");
    $(".text-toast").html(message);
}

/***
 * Fonction de l'echec lors de la creation ou la modification du produit ou categorie
 *
 */

function showError(message) {
    toast.show();
    $(".text-toast")
        .html(message)
        .addClass("alert-danger")
        .removeClass("alert-success");
}

/***
 * Affichage d'un message lors la suppression d'un produit
 *
 */

function showMessageDeleteProduct(onSuccess, message) {
    modalDeleteProduct.hide();
    if (onSuccess) {
        toast.show();
        $(".text-toast")
            .html(message)
            .addClass("alert-success")
            .removeClass("alert-danger");
    } else {
        toast.show();
        $(".text-toast")
            .html(message)
            .addClass("alert-danger")
            .removeClass("alert-success");
    }
}

/****
 * Pour la pagination des produits
 *
 *  */

var $pagination,
    totalRecords = 0,
    records = [],
    displayRecords = [],
    recPerPage = 3,
    page = 1,
    totalPages = 0;

function paginationProduct(products) {
    if (products.length > 0) {
        displayRecords = [];
        $pagination = $("#pagination-products");
        records = products;
        totalRecords = records.length;
        totalPages = Math.ceil(totalRecords / recPerPage);
        applyPaginationProuits();
    } else {
        $(".admin-products").html(
            `<div class="d-flex empty-products justify-content-center align-items-center justify-content-center"><h1>Aucun produit</h1></div>`
        );
    }
}

function applyPaginationProuits() {
    $pagination.twbsPagination("destroy");
    $pagination.twbsPagination({
        totalPages: totalPages,
        visiblePages: 3,
        onPageClick: function (event, page) {
            var displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
            var endRec = displayRecordsIndex + recPerPage;
            displayRecords = records.slice(displayRecordsIndex, endRec);
            generateProduct();
        },
    });
}

function generateProduct() {
    let rep = "";
    for (let produit of displayRecords) {
        rep += construireProduit(produit);
    }
    $(".admin-products").html(rep);
    produitAction();
}

/****
 * Pour la pagination des categs
 *
 *  */

var $paginationCateg,
    totalRecordsCateg = 0,
    recordsCateg = [],
    displayRecordsCateg = [],
    recPerPageCateg = 7,
    page = 1,
    totalPagesCateg = 0;

function paginationCateg(categories) {
    if (categories.length > 0) {
        displayRecordsCateg = [];
        $paginationCateg = $("#pagination-categs");
        recordsCateg = categories;
        totalRecordsCateg = recordsCateg.length;
        totalPagesCateg = Math.ceil(totalRecordsCateg / recPerPageCateg);
        applyPaginationCategs();
    } else {
        $(".admin-list-categs").html(
            `<tr><td colspan="3"><div class="d-flex justify-content-center align-items-center justify-content-center"><h1>Aucune categorie</h1></div></td></tr>`
        );
    }
}

function generateCategs() {
    let rep = "";
    for (let categ of displayRecordsCateg) {
        rep += construireCateg(categ);
    }
    $(".admin-list-categs").html(rep);
    categAction();
}

function applyPaginationCategs() {
    $paginationCateg.twbsPagination("destroy");
    $paginationCateg.twbsPagination({
        totalPages: totalPagesCateg,
        visiblePages: 3,
        onPageClick: function (event, page) {
            var displayRecordsIndex = Math.max(page - 1, 0) * recPerPageCateg;
            var endRec = displayRecordsIndex + recPerPageCateg;
            displayRecordsCateg = recordsCateg.slice(displayRecordsIndex, endRec);
            generateCategs();
        },
    });
}

/**********************************************************************
 *
 *
 *
 * Pour la pagination des membres
 *
 *
 * *********************************************************** */

var $paginationM,
    totalRecordsM = 0,
    recordsM = [],
    displayRecordsM = [],
    recPerPageM = 7,
    page = 1,
    totalPagesM = 0;

function paginationMembre(membres) {
    if (membres.length > 0) {
        displayRecordsM = [];
        $paginationM = $("#pagination-membres");
        recordsM = membres;
        totalRecordsM = recordsM.length;
        totalPagesM = Math.ceil(totalRecordsM / recPerPageM);
        applyPaginationMembre();
    } else {
        $(".admin-list-Ms").html(
            `<tr><td colspan="3"><div class="d-flex justify-content-center align-items-center justify-content-center"><h1>Aucune Membre</h1></div></td></tr>`
        );
    }
}

function generateMembre() {
    let rep = "";
    for (let M of displayRecordsM) {
        rep += construireMembre(M);
    }
    $(".admin-list-membres").html(rep);
    membreAction();
}

function applyPaginationMembre() {
    $paginationM.twbsPagination("destroy");
    $paginationM.twbsPagination({
        totalPages: totalPagesM,
        visiblePages: 3,
        onPageClick: function (event, page) {
            var displayRecordsIndex = Math.max(page - 1, 0) * recPerPageM;
            var endRec = displayRecordsIndex + recPerPageM;
            displayRecordsM = recordsM.slice(displayRecordsIndex, endRec);
            generateMembre();
        },
    });
}

/***
 *
 * Fonction pour chager les produits
 *
 */
function loadProducts(products) {
    paginationProduct(products);
}

/***
 *
 * Fonction pour chager les produits
 *
 */
function loadCategs(categs) {
    paginationCateg(categs);
}

/***
 *
 * Fonction pour chager les membres
 *
 */
function loadMembres(membres) {
    paginationMembre(membres);
}

/***
 *
 * Fonction pour l'affichage du modal pour supprimer un produit
 *
 */
var modalDeleteProduct = new bootstrap.Modal("#delete-product-modal");
function showModalDeleProduct() {
    $(".p-title").text(product.titre);
    $(".p-img").attr("src", product.pochette);
    modalDeleteProduct.show();
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

    $(".category-form-admin").select2({
        placeholder: "Selectionner",
        // allowClear: true,
        theme: "bootstrap-5",
        // tags: true,
    });
    $("#categ-product").select2({
        placeholder: "Selectionner",
        // allowClear: true,
        theme: "bootstrap-5",
        // tags: true,
    });
    $("#sort-admin").select2({
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
        closeFormCateg();
    });

    /***
     *
     * Fermer le formulaire de modification d'une categorie
     */
    $(".close-form-update-categ,.btn-cancel-categ-update").on(
        "click",
        function () {
            closeFormUpdateCateg();
        }
    );

    /***
     * Filtrer par categorie ou Trier
     *
     */

    $("#categ-product,#sort-admin").on("change", function (e) {
        filterProduct();
    });

    /***
     * Rechercher un produit par son titre
     *
     */

    $("#search-products").on("input", function (e) {
        filterProduct();
    });

    /***
     * Rechercher une categorie par son nom
     *
     */

    $("#search-categs").on("input", function (e) {
        filterCateg();
    });

    /***
     * Rechercher une membre par son nom
     *
     */

    $("#search-membres").on("input", function (e) {
        filterMembre();
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

        if (checkDataForm(title, quantity, price, category, description, image)) {
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
            showError("<b>Tous les champs sont requis</b>");
        }
    });

    /***
     * Action sur le button pour creer un produit
     *
     */
    $(".btn-update-product").on("click", function () {
        var title = $("#title-update").val();
        var quantity = $("#quantity-update").val();
        var price = $("#price-update").val();
        var category = $("#categ-update").val();
        var description = $("#description-update").val();
        var image = $("#img-product-update")[0].files[0];
        var image = image ? image : "1";

        if (checkDataForm(title, quantity, price, category, description, image)) {
            manageProduct(
                product?.id,
                title,
                quantity,
                price,
                category,
                description,
                image,
                false
            );
        } else {
            showError("<b>Tous les champs sont requis</b>");
        }
    });

    /***
     *
     * Action sur le deuxieme bouton de confirmation de  suppression du produit
     *
     */
    $(".btn-delete-product").on("click", function (e) {
        e.preventDefault();
        deleteProduct(product?.id);
    });

    /***
     * Action sur le button pour creer une categorie
     *
     */
    $(".btn-save-categ").on("click", function () {
        var title = $("#title-categ").val();
        if (title) {
            manageCateg(0, title, true);
        } else {
            showError("<b>Nom requis</b>");
        }
    });
    /***
     * Action sur le button pour update une categorie
     *
     */
    $(".btn-update-categ").on("click", function () {
        var title = $("#title-categ-update").val();
        if (title) {
            manageCateg(categ?.id, title, false);
        } else {
            showError("<b>Nom requis</b>");
        }
    });
});
