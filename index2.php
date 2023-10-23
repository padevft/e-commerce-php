<?php
  session_start();
  require_once('server/includes/utilitaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boutique en ligne</title>

  
  <link rel="stylesheet" href="client/utilitaires/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="client/utilitaires/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="client/css/styles.css">

</head>


<body>
  <div class="container-app">
    <?php
    require_once('server/includes/header.inc.php');
    ?>
    <main>
      <div class="d-flex align-items-center justify-content-center pt-5 container-intro">
        <span class="text-intro">
          Bienvenue chez nous
        </span>
      </div>
      <div class="container-products">
        <div class="d-flex flex-column align-items-center justify-content-center gap-2 text-center content-intro">
          <span class="text-intro-1"> NOUVEAU PRODUITS</span>
          <span class="text-intro-2">
          Bienvenue dans notre boutique en ligne : tout pour votre espace de travail. Qualité, style et efficacité à portée de clic !          </span>
        </div>
        <?php
        $products = getProducts();
        ?>
        <div class="swiper swiper-products swiper-products-home my-5">
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
        <div class="d-flex align-items-center justify-content-center pt-4">
          <a href="<?= getURL() ?>/server/pages/shop.php" class="view-plus px-3">Voir plus</a>
        </div>
      </div>
  </div>
  </main>
  <?php
  require_once('server/includes/footer.inc.php');
  ?>
  <script src="client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
  <script src="client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
  <script src="client/utilitaires/swiper/swiper-bundle.min.js"></script>
  <script src="client/js/swiper.js"></script>
</body>

</html>