$(document).ready(function() {

  var popup = $("#darkenBackground");

  var selectedOrders = [];

  function popupError(errorStr)
  {
      console.log("Error Triggered");
      $("#errorText").html(errorStr);
      ordrs.hide();
      $("#ordreDetaljer").hide();
      $("#artikkelsearch").hide();
      popup.show();
      $("#errorPopup").show();
    }

  // Try to load order from php. Handles
  // errors on its own.
  function last_ordre(ordrenr)
  {
    $.ajax({
      url: "./PHP/last_ordre.php",
      type: "POST",
      data: {orderNr: ordrenr},
      success: function (response) {
        var r = jQuery.parseJSON(response);
        if (r.success)
        {
          var $od = $("#ordreDetaljer");
          var $table = $('<table />', {
            class: "userInfoTable",
            css: {"min-height": "50px"}
          });

          var $tr1 = $('<tr/>');
          $tr1.append($('<td/>').text('Ordrenr: ' + (r.ordrenr ? r.ordrenr : '-')));
          $tr1.append($('<td/>').text('Dato: ' + (r.date ? r.date : '-')));

          $table.append($tr1);
          $table.insertAfter($od.find("h3"));

          $("#ordrelinje").html(r.ordrelinje);
          console.log(selectedOrders);
          $("#ordrelinje").find("tr").each(function(){
            $(this).addClass("orderListRow");
            $(this).click(function(){
              var on = $(this).attr("id");
              on = on.slice(3);
              var index = jQuery.inArray(on, selectedOrders);
              if (index == -1)
              {
                selectedOrders.push(on);
                $(this).find("td").each(function(){
                  $(this).addClass("tdSelected");
                  console.log("Added");
                });
              }
              else
              {
                selectedOrders.splice(index, 1);
                $(this).find("td").each(function(){
                  $(this).removeClass("tdSelected");
                });
              }
            });
          });

          popup.show();
          $("#searchPopup").show();
          $("#ordreDetaljer").show();
        }
        else
        {
          popupError(r.error);
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
    });
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
    $("#ordreNr").val('');
    if (!orderNr) return;

    // Before we show any popup, check if the
    // order number exists
    last_ordre(orderNr);
  });

  // Search for order first, then load order
  $("#submitTlfNr").click(function() {
    var tlfNr = $("#tlfNr").val();

    if (!tlfNr) return;
    if (tlfNr.toString().length < 8)
    {
      popupError("Telefon nummeret må være minst 8 siffer.");
      return;
    }

    // Before we show any popup, check if the
    // number exists
    $.ajax({
      url: "./PHP/sjekk_tlf.php",
      type: "POST",
      data: {tlfNr: tlfNr},
      success: function (response) {
        console.log(response);
        var r = jQuery.parseJSON(response);
        if (r.success)
        {
          // The $ before the variable doesn't mean anything.
          // It's just a naming scheme for displaying that it
          // is a html element.
          var $os = $("#ordresearch");
          var $table = $('<table />', {class: "userInfoTable"});

          var $tr1 = $('<tr/>');
          $tr1.append($('<td/>').text('Kundenr: ' + (r.kundenr ? r.kundenr : '-')));
          $tr1.append($('<td/>').text(r.navn ? r.navn : "-"));

          var $tr2 = $('<tr/>');
          $tr2.append($('<td/>').text("Tlf:" + r.tlf ? r.tlf : "-"));
          $tr2.append($('<td/>').text(r.adresse ? r.adresse : "-"));

          $table.append($tr1);
          $table.append($tr2);
          $os.prepend($table);

          var elem = $('<h3/>', {
            css: {"text-align": "center"},
            text: "Medlem funnet:"
          });
          $os.prepend(elem);

          $("#ordresearchresults").html(r.ordreliste);

          // Add onclicks and effects to each row
          $("#ordresearchresults").find("tr").each(function(){
            $(this).addClass("orderListRow");
            $(this).click(function(){
              $os.hide();
              var ordrenr = $(this).attr("id");
              ordrenr = ordrenr.slice(3);
              last_ordre(ordrenr);
            });
          });

          popup.show();
          $("#searchPopup").show();
          $os.show();

          $("#tlfNr").val('');
        }
        else
        {
          popupError(r.error);
          $("#tlfNr").val('');
        }
      }
    });
  });

  $("#submitArtNr").click(function() {
    popup.show();
    $("#artikkelsearch").show();
  });

  $("#artNrReturBtn").click(function() {

  });

  $("#artNrReklamasjonBtn").click(function() {

  });

});
