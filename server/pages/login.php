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
        <div class="d-flex align-items-center justify-content-center container-login">
            <div class="content-login">
                <div class="d-flex justify-content-center align-items-center pb-4">
                    <span class="fw-semibold text-login">Se connecter</span>
                </div>
                <div class="container-form d-flex flex-column gap-4">
                    <div class="d-flex flex-column gap-2">
                        <label for="email-login" class="fw-semibold">Email</label>
                        <input type="email" id="email-login" class="form-control fw-semibold input-login" placeholder="Email" />
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label for="pwd-login" class="fw-semibold">Mot de passe</label>
                        <input type="password" id="pwd-login" class="form-control fw-semibold input-login" placeholder="Mot de passe" />
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-dark px-3">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once('../includes/footer.inc.php');
    ?>
    <script src="../../client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/popper.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>