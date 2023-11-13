var liveToast = document.getElementById("liveToast");
var toast = new bootstrap.Toast(liveToast);

function showMessageM(message, class1, class2) {
  toast.show();
  $(".text-toast").html(message).addClass(class1).removeClass(class2);
}

/***
 * Function pour ajouter dans le panier
 *
 */
function addProductCart() {
  $(".item-product").on("click", ".add-product-cart", function () {
    var idm = $("#idm").val();
    var idp = $(this).data("product-id");
    managePanier(idm, idp, 1, "add-panier");
  });
}

function loadProductsM(produits) {
  var length = produits?.length;

  $(".number-products").html(length);

  let rep = `<div class="d-flex empty-products justify-content-center align-items-center justify-content-center"><h1>Aucun produit</h1></div>`;

  if (length > 0) {
    rep = ``;
    for (var produit of produits) {
      rep += construireProduitA(produit);
    }
    $(".swiper-products .swiper-wrapper").html(rep);
    $(".swiper-products").addClass("d-block").removeClass("d-none");
    $(".empty-p .empty-products").remove();

    new Swiper(".swiper-products", options);
    addProductCart();
  } else {
    $(".swiper-products").addClass("d-none").removeClass("d-block");
    $(".empty-p").html(rep);
  }
}

function manageCart() {
  $(".products-cart").on("input", ".quantite-panier", function (e) {
    var idm = $("#idm").val();
    var idp = $(this).data("product-id");
    var quantite = !$(this).val() || $(this).val() == "0" ? 1 : $(this).val();
    $(this).val(quantite);
    managePanier(idm, idp, quantite, "update-panier");
  });

  $(".products-cart").on("click", ".delete-product-cart", function (e) {
    var idm = $("#idm").val();
    var idp = $(this).data("product-id");
    managePanier(idm, idp, 0, "delete-panier");
  });


}

function loadProductsPanier(produits) {
  var length = produits?.length;
  $(".number-products-panier").html(length);
  $(".total-amount").html(`0$`)
  if (length > 0) {
    let rep = "";
    for (var produit of produits) {
      rep += construireProduitPanier(produit);
    }
    $(".products-cart").html(rep);

    $(".total-amount").html(`${produits[length - 1]["montantTotalPanier"]} $`);
    manageCart();
  } else {
    $(".products-cart").html(`<tr><td colspan='5'>Aucun produit dans le panier.</td></tr>`);
  }
}

$(function () {
  /*************************************************************************
   * Fonction pour voir ou cacher le mot de passe
   *
   */

  $("#member-password").on("click", function (e) {
    var type =
      $("#pwd-login").attr("type") === "password" ? "text" : "password";
    $("#pwd-login").attr("type", type);
  });

  /*************************************************************************
   * Afficher tous les produits en fonction d'une categorie
   *
   */
  $(".container-categs").on("click", ".item-categ", function () {
    $("#categ-product-member").val($(this).attr("data-id"));
    $(".categ-value").html($(this).attr("data-nom"));
    filterProductMember();
  });

  /*************************************************************************
   * Afficher tous les produits
   *
   */
  $(".all-categ").on("click", function () {
    $("#categ-product-member").val(0);
    $(".categ-value").html("Categories confodues");
    filterProductMember();
  });

  /*************************************************************************
   * Rechercher un produit a partir de la barre de recherche
   *
   */

  $("#search-products").on("input", function (e) {
    filterProductMember();
  });

  /*************************************************************************
   * Trier
   *
   */

  $("#sort-member").on("change", function (e) {
    filterProductMember();
  });

  addProductCart();
  manageCart();

  /**********************************************************************
   *
   *
   * Resultat modification
   *
   */
  if ($("#result-update-profile") && $("#result-update-profile").val()) {
    var val = $("#result-update-profile").val();
    if ($("#result-update-profile").attr("data-success") === "1") {
      showMessageM(val, "alert-success", "alert-danger");
    } else {
      showMessageM(val, "alert-danger", "alert-success");
    }
  }

  /**********************************************************************
   *
   *
   * Resultat paiement
   *
   */
  if ($("#result-pay") && $("#result-pay").val()) {
    var myModal = new bootstrap.Modal('#modal-paiement', {})
    myModal.show();
  }

});
