
$(document).ready(function() {
  $.ajax({
    url: "./PHP/skaff_kategorier.php",
    type: "POST",
    success: function (result)
    {
      $("#kategori").append(result);
    }
  });
});
