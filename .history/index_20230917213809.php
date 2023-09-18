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
      require_once('server/includes/header.php');
   ?>
    <main>
      <h1>Boutique en ligne 1</h1>
      <h2>Boutique en ligne 2</h2>
      <div class="main">
        test
        <div class="container-product-items">
          <div class="thumbnails">
            <img class="w-100" src="client/images/home-consulting.png" alt="Personal Portfolio Images">
            <a target="_blank" href="https://rainbowit.net/html/inbio/home-consulting.html" class="preview-btn">
              <span class="rn-btn">Live Preview <i class="feather-external-link"></i></span>
            </a>
          </div>

          <div class="content">
            <h3 class="title"><a href="https://rainbowit.net/html/inbio/home-consulting.html">Consulting<i
                  class="feather-arrow-up-right"></i></a></h3>
          </div>
        </div>
      </div>
    </main>
    <footer>

    </footer>



    <script src="client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>