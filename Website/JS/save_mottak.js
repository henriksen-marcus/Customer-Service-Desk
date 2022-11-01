$(document).ready(function(){
  $("form").submit(function(event){
    event.preventDefault();
    var mlnr = $('#mottaksnr').val();
    var sumvarer = $('#sumvarer').val();
    var dato = $('#dato').val();
    if (mlnr && sumvarer && dato) {
      $.ajax({
        url: "./PHP/save_mottak.php",
        type: "POST",
        data: {
          mlnr: mlnr,
          sumvarer: sumvarer,
          dato: dato
        },
        cache: false,
        success: function(){
          $("#success").html('Data added successfully');
        },
        error: function( jqXHR, textStatus, errorThrown ){
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
        }
      });
    }
    else {
      alert("Please fill inn all the fields");
    }
  });
});
