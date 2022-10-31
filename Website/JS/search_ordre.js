$(document).ready(function() {
    var popup = $("#darkenBackground");

    // Why the fuck does it propogate the child elems??
    popup.click(function(event)
    {
      if (event.target.id == "darkenBackground")
      {
        $(this).hide();
        $("#searchPopup").hide();
        $("#errorPopup").hide();
        $("#errorText").html("");
      }
    });

  // Load order directly
  $("#submitOrdreId").click(function() {
    var orderNr = $("#ordreNr").val();

    // Before we show any popup, check if the
    // order number exists

    $.ajax({
      url: "./PHP/last_ordre.php",
      type: "POST",
      data: {orderNr: orderNr},
      //dataType: "JSON",
      success: function (response) {
        console.log(response);
        responseObj = jQuery.parseJSON(response);
        console.log(responseObj);
        if (responseObj.success)
        {
          $("#OrdreNrResult").html(responseObj.ordreNr);
          $("#DatoResult").html(responseObj.date);
          $("#ordrelinje").html(responseObj.ordrelinje);

          popup.show();
          $("#ordreDetaljer").show();
        }
        else
        {
          console.log("Error Triggered");
          $("#errorText").html(responseObj.error);
          $("#errorPopup").show();
          popup.show();
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
    });
  });

  // Search for order first, then load order
  $("#submitTlfNr").click(function() {
    popup.show();
    //$("#ordreDetaljer").show();
    $("#ordresearch").show();
  });


  $("#submitArtNr").click(function() {
    popup.show();
    $("#artikkelsearch").show();
  });

});
