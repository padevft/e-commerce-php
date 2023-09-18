<?php
require_once('server/includes/utilitaires.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boutique en ligne</title>

  <link rel="stylesheet" href="client/css/styles.css">
  <link rel="stylesheet" href="client/utilitaires/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="client/utilitaires/font-awesome-4.7.0/css/font-awesome.min.css">

</head>


<body>
  <div class="container-app">
    <?php
    require_once('server/includes/header.inc.php');
    ?>
    <main>
      <div class="d-flex align-items-center justify-content-center pt-5 container-intro">
        <span class="text-intro">
          Acheter vos livres
        </span>
      </div>
      <div class="container-products">
        <div class="d-flex flex-column align-items-center justify-content-center gap-2 text-center content-intro">
          <span class="text-intro-1"> NOUVEAU PRODUITS</span>
          <span class="text-intro-2">
            Vous trouverez une vaste collection de livres captivants, allant des classiques intemporels aux best-sellers contemporains. Plongez-vous dans des univers fantastiques, explorez des époques passées, et vivez des aventures palpitantes à travers les mots.
          </span>
        </div>
        <?php
        $products = getProducts();
        ?>
        <div class="content-products">
          <div class="grid-products-shop">
            <?php foreach ($products as $product) : ?>
              <?= getHtmlProucut($product) ?>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-center pt-4">
          <a href="./index.php" class="view-plus px-3">Voir plus</a>
        </div>
      </div>
  </div>
  </main>
  <?php
  require_once('server/includes/footer.inc.php');
  ?>
  <script src="client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
  <script src="client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>