<?php
require_once('../includes/utilitaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boutique en ligne</title>
  
  <link rel="stylesheet" href="../../client/utilitaires/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../client/utilitaires/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="../../client/css/styles.css">

</head>

<body>
  <div class="container-app">
    <?php
    require_once('../includes/header.inc.php');
    ?>
    <main>
      <div class="d-flex align-items-center justify-content-center pt-5 container-intro">
        <span class="text-intro">
          Retrouvez tous nos differents produits
        </span>
      </div>
      <div class="container-products">
        <div class="pb-5 container-search">
          <div class="d-flex align-items-center gap-2 content-search">
            <span><i class="fa fa-search"></i></span>
            <input type="text" class="form-control input-search" placeholder="Rechercher ..." />
          </div>
        </div>
        <?php
        $products = getProducts();
        $categories = getProductCategories();
        ?>
        <div class="content-products">
          <div class="row">
            <div class="col-sm-4 col-md-3 sticky-top container-sticky-categ pt-4">
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
                  <span class="fw-semibold">Categorie: <span class="categ-value">Chaise</span></span>
                  <span class="fw-semibold">1–12 de 40 resultats</span>
                  <div class="d-flex align-items-center justify-content-center gap-2">
                    <span class="fw-semibold">
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
  <script src="../../client/utilitaires/swiper/swiper-bundle.min.js"></script>
  <script src="../../client/js/swiper.js"></script>
</body>

</html>