$(document).ready(function(){
  $("form").submit(function(event){
    event.preventDefault();
    var sumvarer = $("#sumvarer").val();
    console.log($("#sumvarer"));
    console.log("Yeet baboon");
    if (sumvarer) {
      $.ajax({
        url: "./PHP/save_mottak.php",
        type: "POST",
        data: {
          sumvarer: sumvarer
        },
        success: function(response){
          console.log(response);
          var r = JSON.parse(response);
          if (r.success) {
            $("#success").html('Data added successfully');
          }
          else {
            $("#success").html('Data not added' + r.error);
          }
        },
        error: function( jqXHR, textStatus, errorThrown ){
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
        }
      });
    }
    else {
      console.log($('#sumvarer').val());
    }
  });
});
