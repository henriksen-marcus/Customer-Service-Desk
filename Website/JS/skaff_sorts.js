$(document).ready(function() {

  $.ajax({
    url: "./PHP/skaff_sorts.php",
    type: "POST",
    success: function (result)
    {
      $("#sorter").append(result);
    }
  });

});
