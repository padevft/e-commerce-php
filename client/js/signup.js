var liveToast = document.getElementById("liveToast");
var toast = new bootstrap.Toast(liveToast);

function showMessageM(message, class1, class2) {
  toast.show();
  $(".text-toast").html(message).addClass(class1).removeClass(class2);
}


$(function () {

  /**********************************************************************
   *
   *
   * Resultat error lors du sign up
   *
   */
  if ($("#result-signup") && $("#result-signup").val()) {
    var val = $("#result-signup").val();
    showMessageM(val, "alert-danger", "alert-success");
  }
});
