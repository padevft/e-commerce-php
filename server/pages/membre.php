<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../../index.php');
    exit();
}
require_once('../includes/utilitaires.inc.php');
require_once('../product/modeleProduit.php');
require_once('../category/modeleCategory.php');
require_once('../panier/modelePanier.php');
$categories = Mdl_Categs();
$categories = $categories['data'];
$products = Mdl_Produits();
$products = $products['data'];
$products_panier = Mdl_Produits_Panier($_SESSION['idm']);
$products_panier = $products_panier['data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Membre</title>
    <link rel="stylesheet" href="../../client/css/styles.css">
    <link rel="stylesheet" href="../../client/utilitaires/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/select/select2.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/select/select2-bootstrap-5-theme.min.css">
    <link rel="stylesheet" href="../../client/utilitaires/swiper/swiper-bundle.min.css">

</head>

<body>
    <div class="container-app">
        <header>
            <nav class="container-nav">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="d-flex flex-row align-items-center">
                            <a class="container-logo" href="javascript:document.getElementById('formDec').submit();">
                                <img src="<?= getURL() ?>/client/images/log.png" />
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="d-flex align-items-center gap-4 justify-content-end mt-2">
                            <div class="container-menu">
                                <ul class="d-flex align-items-center gap-4 menu">
                                    <li> <a href="#" class="menu-item" data-bs-toggle="modal" data-bs-target="#modal-profile">Profile</a></li>
                                    <li> <a href="javascript:document.getElementById('formDec').submit();" class="menu-item">Deconnexion</a></li>
                                    <li>
                                        <a href="#" class="menu-item" data-bs-toggle="modal" data-bs-target="#modal-panier">
                                            <div class="position-relative container-shopping-cart">
                                                <span><i class="fa fa-shopping-cart shopping-cart"></i></span>
                                                <span class="position-absolute number-product number-products-panier"><?= count($products_panier) ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="d-flex flex-column text-white">
                                            <span class="text-center"><i class="fa fa-user"></i></span>
                                            <span><?php echo $_SESSION['prenom'] . " " . $_SESSION['nom'] ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-body">
            <div class="d-flex align-items-center justify-content-center pt-5 container-intro">
                <span class="text-intro">
                    Retrouvez tous nos differents produits
                </span>
            </div>
            <div class="container-products">
                <div class="pb-3 container-search">
                    <div class="d-flex align-items-center gap-2 content-search">
                        <span><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control input-search" id="search-products" placeholder="Rechercher ..." />
                    </div>
                </div>
                <div class="content-products">
                    <div class="row">
                        <div class="col-sm-4 col-md-3 sticky-top container-sticky-categ pt-4">
                            <div class="container-text-category pb-2">
                                <span class="text-category">CATÉGORIES DE PRODUITS</span>
                            </div>
                            <div class="container-categs pt-4">
                                <?php foreach ($categories as $category) : ?>
                                    <?= getHtmlProucutCategory($category) ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between all-categ">
                                    <span class="text-categ-item">Categories confodues</span>
                                    <span class="number-categ-item">(<?= count($products) ?>)</span>
                                </div>
                            </div>
                            <input type="hidden" id="categ-product-member" value="0" />
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="container-header-product">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">Categorie: <span class="categ-value">Categories confodues</span></span>
                                    <span class="fw-semibold"><span class="number-products"><?= count($products) ?></span> produit(s)</span>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="fw-semibold">
                                            Trie par :
                                        </span>
                                        <div class="dropdown">
                                            <select class="form-select" id="sort-member">
                                                <option value="titre">Titre</option>
                                                <option value="prix">Prix</option>
                                                <option value="prix_desc">Prix Desc</option>
                                                <option value="quantite">Quantite</option>
                                                <option value="quantite_desc">Quantite Desc</option>
                                                <option value="date_ajout">Date ajout </option>
                                                <option value="date_ajout_desc">Date ajout Desc</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper swiper-products">
                                <div class="swiper-wrapper">
                                    <?php foreach ($products as $product) : ?>
                                        <div class="swiper-slide"><?= getHtmlProucut($product) ?></div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-button-next">
                                </div>
                                <div class="swiper-button-prev">
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="empty-p"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulaire de deconnexion -->
    <form action="../connexion/controleurConnexion.php" id="formDec" method="post">
        <input type="hidden" name="action" value="deconnexion" />
    </form>
    <!-- Modal du profile  -->
    <form action="../membre/controleurMembre.php" method="post">
        <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="modal-profile">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">

                    <input type="hidden" name="action" value="modification-membre" />
                    <input type="hidden" name="idm" id="idm" value="<?= $_SESSION['idm'] ?>" />
                    <?php if (isset($_SESSION['msg'])) {
                        echo '<input type="hidden" id="result-update-profile" value="' . $_SESSION['msg'] . '" data-success="' . $_SESSION['success-p'] . '"/>';
                    }
                    ?>
                    <div class="modal-header px-4">
                        <h5 class="modal-title" style="font-size: 2rem; font-weight:bolder">Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-2">
                            <div class="col-4">
                                <div class="d-flex justify-content-center aligin-items-center">
                                    <?php if ($_SESSION['sexe'] == 'M') {
                                        $avatar = getURL() . "/client/images/avatar_man.png";
                                    } else {
                                        $avatar = getURL() . "/client/images/avatar_woman.png";
                                    } ?>
                                    <img src="<?= $avatar ?>" class="img-fluid  p-img" alt="Image">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row px-3">
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="name-login" class="fw-semibold">Nom</label>
                                            <input type="text" name="nom" id="name-login" class="form-control fw-semibold input-login" placeholder="Nom" value="<?= $_SESSION['nom'] ?>" />
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="fristname-login" class="fw-semibold">Prénom</label>
                                            <input type="text" name="prenom" id="fristname-login" class="form-control fw-semibold input-login" placeholder="Prénom" value="<?= $_SESSION['prenom'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 pt-3">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="sexe-login" class="fw-semibold">Sexe</label>
                                            <select class="form-select fw-semibold input-login" name="sexe" id="sexe-login" aria-label="Default select example">
                                                <option value="M" <?php if ($_SESSION['sexe'] === 'M') echo 'selected'; ?>>M</option>
                                                <option value="F" <?php if ($_SESSION['sexe'] === 'F') echo 'selected'; ?>>F</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 pt-3">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="birthday-login" class="fw-semibold">Date de naissance</label>
                                            <input type="date" id="birthday-login" name="daten" class="form-control fw-semibold input-login" placeholder="Date de naissance" value="<?= $_SESSION['datenaissance'] ?>" />

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 pt-3">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="email-login" class="fw-semibold">Email</label>
                                            <input type="email" id="email-login" class="form-control fw-semibold input-login" placeholder="Email" value="<?= $_SESSION['courriel'] ?>" disabled />
                                            <input type="hidden" name="courriel" value="<?= $_SESSION['courriel'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 pt-3">
                                        <div class="d-flex flex-column gap-2">
                                            <label for="pwd-login" class="fw-semibold">Mot de passe</label>
                                            <div class="input-group">
                                                <input type="password" id="pwd-login" name="mdp" class="form-control fw-semibold input-login" placeholder="Mot de passe" pattern="[A-Za-z0-9_\$#\-]{6,10}" value="<?= $_SESSION['mdp'] ?>" />
                                                <button class="btn btn-secondary" type="button" id="member-password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-dark btn-update-profile">
                            Sauvegarder
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal du Panier  -->
    <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="modal-panier">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-5 panier-header">
                    <div class="d-flex gap-5 align-items-center">
                        <a class="container-logo" href="#" data-bs-dismiss="modal">
                            <img src="<?= getURL() ?>/client/images/log.png" />
                        </a>
                        <h5 class="modal-title panier-title">PANIER D'ACHAT</h5>
                    </div>
                    <button type="button" class="close-panier btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="p-2">
                        <div class="table-responsive table-cart">
                            <table class="table rounded border my-2 bg-white  text-center">
                                <thead class="thead-cart">
                                    <tr style="font-size:1.2rem;">
                                        <th scope="col" class="col-2">IMAGE</th>
                                        <th scope="col" class="col-4">PRODUIT</th>
                                        <th scope="col">PRIX</th>
                                        <th scope="col" class="col-2">QUANTITE</th>
                                        <th scope="col">TOTAL</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle products-cart">
                                    <?php
                                    if (!empty($products_panier)) {
                                        foreach ($products_panier as $product) {
                                            echo getHtmlProucutPanier($product);
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">Aucun produit dans le panier</td></tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="cart-paypal">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="d-flex w-100 align-items-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Continuer vos achats
                        </button>
                        <div class="flex-grow-1 amount px-5">
                            <div class="d-flex gap-3 justify-content-end">
                                <div class="cart-total-amount gap-5 text-white">
                                    <span class="label-total-amount">Total</span>
                                    <span class="label-total-amount total-amount">
                                        <?php
                                        if (!empty($products_panier)) {
                                            echo '<span class="label-total-amount total-amount">' . $products_panier[count($products_panier) - 1]['montantTotalPanier'] . '$</span>';
                                        } else {
                                            echo '<span class="label-total-amount total-amount">0$</span>';
                                        }
                                        ?>

                                    </span>
                                </div>
                                <button type="button" class="btn btn-pay px-3" data-bs-dismiss="modal">
                                    PAIEMENT
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast  -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 999">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body px-2">
                <div class="alert px-2 text-toast">
                </div>
            </div>
        </div>
    </div>

    <script src="../../client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/popper.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../client/utilitaires/Jquery/jquery.twbsPagination.min.js"></script>
    <script src="../../client/utilitaires/select/select2.min.js"></script>
    <script src="../../client/utilitaires/swiper/swiper-bundle.min.js"></script>
    <script src="../../client/js/swiper.js"></script>
    <script src="../../client/js/requette.js"></script>
    <script src="../../client/js/helper.js"></script>
    <script src="../../client/js/membre.js"></script>
</body>
<?php unset($_SESSION['msg']);
unset($_SESSION['success-p']); ?>

</html>