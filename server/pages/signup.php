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
        <div>
            <div class="d-flex align-items-center justify-content-center py-5">
                <div class="content-signup">
                    <div class="d-flex justify-content-center align-items-center pb-4">
                        <span class="fw-semibold text-login">S'inscrire</span>
                    </div>
                    <div class="container-form d-flex flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-md-row align-items-center gap-2">
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="name-login" class="fw-semibold">Nom</label>
                                <input type="text" id="name-login" class="form-control fw-semibold input-login" placeholder="Nom" />
                            </div>
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="fristname-login" class="fw-semibold">Prénom</label>
                                <input type="text" id="fristname-login" class="form-control fw-semibold input-login" placeholder="Prénom" />
                            </div>
                        </div>

                        <div class="d-flex flex-sm-column flex-md-row align-items-center justify-content-between gap-2">
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="sexe-login" class="fw-semibold">Sexe</label>
                                <select class="form-select fw-semibold input-login" id="sexe-login" aria-label="Default select example">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="birthday-login" class="fw-semibold">Date de naissance</label>
                                <input type="date" id="birthday-login" class="form-control fw-semibold input-login" placeholder="Date de naissance" />

                            </div>
                        </div>

                        <div class="d-flex flex-sm-column flex-md-row align-items-center gap-2">
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="email-login" class="fw-semibold">Email</label>
                                <input type="email" id="email-login" class="form-control fw-semibold input-login" placeholder="Email" />
                            </div>
                        </div>

                        <div class="d-flex flex-sm-column flex-md-row align-items-center gap-2">
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="pwd-login" class="fw-semibold">Mot de passe</label>
                                <input type="password" id="pwd-login" class="form-control fw-semibold input-login" placeholder="Mot de passe" />
                            </div>
                            <div class="d-flex col-12 col-md-6 flex-column gap-2">
                                <label for="conform-pwd-login" class="fw-semibold">Confirmer mot de passe</label>
                                <input type="password" id="conform-pwd-login" class="form-control fw-semibold input-login" placeholder="Confirmer mot de passe" />
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-dark px-4">S'inscrire</button>
                        </div>
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