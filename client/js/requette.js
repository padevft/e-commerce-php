$("#login-btn").click(function () {
    var courriel = $("#email-login").val();
    var mdp = $("#pwd-login").val();

    // Envoi des données au script PHP via AJAX
    $.ajax({
        type: "POST",
        url: "../connexion/controleurConnexion.php", // Nom du script PHP de traitement de la connexion
        data: { courriel: courriel, mdp: mdp },
        success: function (response) {
            console.log(response);
            if (response["success"] === 1) {
                // Rediriger vers la page appropriée en fonction du rôle
                if (response["role"] === "M") {
                    window.location.href = "../pages/membre.php";
                } else if (response["role"] === "A") {
                    window.location.href = "../pages/admin.php";
                } else {
                    alert("Rôle non reconnu.");
                }
                alert("Ok");
            } else {
                alert(response["message"]);
            }
        },
        error: function (xhr, status, error) {
            alert("Erreur AJAX: " + status + " - " + error);
        },
    });
});
