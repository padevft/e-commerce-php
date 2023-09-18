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

      </div>
    </main>
    <footer>
      <div class="container-footer">
        <span>Auteur: BShop</span>
        <span>Email: info@bshoop.com</span>
      </div>

    </footer>



    <script src="client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>