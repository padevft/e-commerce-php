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
        <div class="d-flex flex-column align-items-center justify-content-center gap-2">
          <span class="text-intro-1"> NOUVEAU PRODUITS</span>
          <span class="text-intro-2">There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form
          </span>
        </div>
        <?php
        $products = get_products();
        global $des;
        ?>

        <!-- <div class="grid-products">
          <?php foreach ($products as $product) : ?>
            <div class="card position-relative item-product" style="width: 18rem;">
              <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product['title']; ?></h5>
                <p class="card-text"><?php echo $product['description']; ?></p>
                <a href="<?php echo $product['link']; ?>" class="btn btn-primary">Go somewhere</a>
              </div>
              <div class="text-product">
                <span class="text-product-1"><?php echo $product['text_1']; ?></span>
                <span class="text-product-2"><?php echo $product['text_2']; ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div> -->


        <div class="content-products">
          <div class="grid-products">
            <?php foreach ($products as $product) : ?>
              <div class="card position-relative item-product" style="width: 18rem;">
                <img src="client/images/p-2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title title-product">Card title</h5>
                  <p class="card-text"><?= get_sub_description($des); ?></p>
                  <span class="text-price">$2500</span>
                </div>
                <div class="text-product">
                  <span class="title-product">
                    Card title
                  </span>
                  <div class="align-items-end">
                    <div class="icons">
                      <a href="#" class="icon">
                        <i class="fab fa-github"></i>
                      </a>
                      <a href="#" class="icon">
                        <i class="fab fa-behance"></i>
                      </a>
                      <a href="#" class="icon">
                        <i class="fab fa-youtube"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
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