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
    <header>
      <nav class="container-nav">
        <div class="row align-items-center">
          <div class="col-12 col-sm-4">
            <div class="d-flex flex-row align-items-center">
              <a class="container-logo" href="./index.html">
                <img src="client/images/logo.png" />
              </a>
              <span class="text-logo">BShoop</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="container-menu mt-2">
              <ul class="d-flex flex-row align-items-center justify-content-end gap-4 menu">
                <li><a href="./index.html" class="menu-item">Accueil</a></li>
                <li><a href="./index.html" class="menu-item">Contactez-nous</a></li>
              </ul>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <div class="d-flex align-items-center gap-4 justify-content-end mt-2">
              <div class="container-menu">
                <ul class="d-flex align-items-center gap-4 menu">
                  <li> <a href="./index.html" class="menu-item">S'inscrire</a></li>
                  <li> <a href="./index.html" class="menu-item">Se connecter</a></li>
                </ul>

              </div>
              <div class="position-relative container-shopping-cart">
                <span><i class="fa fa-shopping-cart shopping-cart"></i></span>
                <span class="position-absolute number-product">2</span>
              </div>
            </div>

          </div>

        </div>
      </nav>
      <div class="d-flex align-items-center justify-content-center pt-5">
        <span class="text-intro">
          Acheter vos livres
        </span>
      </div>
    </header>
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