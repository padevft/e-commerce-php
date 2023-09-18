<?php
require_once('../includes/utilitaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boutique en ligne</title>
  <link rel="stylesheet" href="../../client/css/styles.css">
  <link rel="stylesheet" href="../../client/utilitaires/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="container-app">
    <?php
    require_once('../includes/header.inc.php');
    ?>
    <main>
      <div class="d-flex align-items-center justify-content-center pt-5 container-intro">
        <span class="text-intro">
          Acheter vos livres
        </span>
      </div>
      <div class="container-products">
        <div class="pb-5 container-search">
          <div class="d-flex align-items-center gap-2 content-search">
            <span><i class="fa fa-search"></i></span>
            <input type="text" class="form-control input-search" placeholder="Rechercher un livre" />
          </div>
        </div>
        <?php
        $products = getProducts();
        $categories = getProductCategories();
        ?>
        <div class="content-products">
          <div class="row">
            <div class="col-sm-4 col-md-3 sticky-top container-sticky-categ">
              <div class="container-text-category pb-2">
                <span class="text-category">CATÉGORIES DE PRODUITS</span>
              </div>
              <div class="pt-4">
                <?php foreach ($categories as $category) : ?>
                  <?= getHtmlProucutCategory($category) ?>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="col-sm-8 col-md-9">
              <div class="container-header-product">
                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-semibold">Categorie: <span class="categ-value">Biography</span></span>
                  <span class="fw-semibold">Showing 1–12 of 40 results</span>
                  <div class="d-flex align-items-center justify-content-center gap-2">
                    <span class="fw-semibold ">
                      Trie par :
                    </span>
                    <div class="dropdown">
                      <span class="fw-semibold item-sorting dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Tri par défaut
                      </span>
                      <ul class="dropdown-menu">
                        <li><span class="dropdown-item fw-semibold item-sorting">Nom</span></li>
                        <li><span class="dropdown-item fw-semibold item-sorting">Prix</span></li>
                        <li><span class="dropdown-item fw-semibold item-sorting">Tri par défaut</span></li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
              <div class="grid-products-shop pt-2">
                <?php foreach ($products as $product) : ?>
                  <?= getHtmlProucut($product) ?>
                <?php endforeach; ?>
              </div>
              <div class="d-flex align-items-center justify-content-center pt-4">
                <a href="./index.php" class="view-plus px-3">Voir plus</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </main>
  <?php
  require_once('../includes/footer.inc.php');
  ?>
  <script src="../../client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
  <script src="../../client/utilitaires/bootstrap/js/popper.min.js"></script>
  <script src="../../client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>