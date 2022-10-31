$(document).ready(function() {
    var popup = $("#darkenBackground");

    function popupError(errorStr)
    {
      console.log("Error Triggered");
      $("#errorText").html(errorStr);
      $("#errorPopup").show();
      popup.show();
    }

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

    if (!orderNr) return;

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
          $("#ordreNr").val('');
          $("#OrdreNrResult").html(responseObj.ordreNr);
          $("#DatoResult").html(responseObj.date);
          $("#ordrelinje").html(responseObj.ordrelinje);
          popup.show();
          $("#searchPopup").show();
          $("#ordreDetaljer").show();
        }
        else
        {
          popupError(responseObj.error);
          $("#ordreNr").val('');
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
    var tlfNr = $("#tlfNr").val();

    if (!tlfNr) return;
    if (tlfNr.toString().length < 8)
    {
      popupError("Telefon nummeret må være minst 8 siffer.");
    }

    // Before we show any popup, check if the
    // number exists
    $.ajax({
      url: "./PHP/sjekk_tlf.php",
      type: "POST",
      data: {tlfNr: tlfNr},
      success: function (response) {
        console.log(response);
        responseObj = jQuery.parseJSON(response);
        if (responseObj.success)
        {
          $("#KundeNrResult").html(responseObj.kundnr);
          $("#DatoResultOrdreSearch").html(responseObj.dato);
          $("#NavnResult").html(responseObj.navn);
          $("#adresseResult").html(responseObj.adresse);
          $("#tlfNrResult").html(responseObj.tlf);
          $("#ordresearchresults").html(responseObj.ordreliste);

          popup.show();
          $("#searchPopup").show();
          $("#ordresearch").show();
        }
        else
        {
          popupError(responseObj.error);
          $("#tlfNr").val('');
        }
      }
    });

    // $.ajax({
    //   url: "./PHP/last_ordre.php",
    //   type: "POST",
    //   data: {orderNr: orderNr},
    //   //dataType: "JSON",
    //   success: function (response) {
    //     console.log(response);
    //     responseObj = jQuery.parseJSON(response);
    //     if (responseObj.success)
    //     {
    //       $("#ordreNr").val('');
    //       $("#OrdreNrResult").html(responseObj.ordreNr);
    //       $("#DatoResult").html(responseObj.date);
    //       $("#ordrelinje").html(responseObj.ordrelinje);
    //       popup.show();
    //       $("#searchPopup").show();
    //       $("#ordreDetaljer").show();
    //     }
    //     else
    //     {
    //       popupError(responseObj.error);
    //       $("#ordreNr").val('');
    //     }
    //   },
    //   error: function (jqXHR, textStatus, errorThrown)
    //   {
    //     console.log(jqXHR);
    //     console.log(textStatus);
    //     console.log(errorThrown);
    //   }
    // });
  });


  $("#submitArtNr").click(function() {
    popup.show();
    $("#artikkelsearch").show();
  });

});
