<?php
session_start();
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
        <form action="../connexion/controleurConnexion.php" method="post">
            <div class="d-flex align-items-center justify-content-center container-login">
                <div class="content-login">
                    <div class="d-flex justify-content-center align-items-center pb-4">
                        <span class="fw-semibold text-login">Se connecter</span>
                    </div>
                    <div class="container-form d-flex flex-column gap-4">
                        <input type="hidden" name="action" value="connexion" />
                        <div class="d-flex flex-column gap-2">
                            <label for="email-login" class="fw-semibold">Email</label>
                            <input type="email" name="courriel" id="email-login" class="form-control fw-semibold input-login" placeholder="Email" />
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <label for="pwd-login" class="fw-semibold">Mot de passe</label>
                            <input type="password" name="mdp" id="pwd-login" class="form-control fw-semibold input-login" placeholder="Mot de passe" pattern="[A-Za-z0-9_\$#\-]{6,10}" />
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-dark px-3" id="login-btn">Se connecter</button>
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION['msg'])) {
                    echo '<input type="hidden" id="result-signup" value="' . $_SESSION['msg'] . '"/>';
                }
                ?>
            </div>
        </form>
    </div>
    <?php
    require_once('../includes/footer.inc.php');
    ?>

    <!-- Toast  -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 999">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-white px-2">
                <div class="alert px-2 text-toast">
                </div>
            </div>
        </div>
    </div>
    <script src="../../client/utilitaires/Jquery/jquery-3.6.0.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/popper.min.js"></script>
    <script src="../../client/utilitaires/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../client/js/signup.js"></script>
</body>
<?php unset($_SESSION['msg']); ?>

</html>
?>