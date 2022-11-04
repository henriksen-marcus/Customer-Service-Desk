$(document).ready(function() {

  var popup = $("#darkenBackground");

  var currentOrder;
  var selectedOrders = [];

  function popupError(errorStr)
  {
      console.log("Error triggered");
      $("#errorText").text(errorStr);
      $(".errorOverlay").show();
    }

  // Why the fuck does it propogate the child elems??
  popup.click(function(event)
    {
      if (event.target.id == "darkenBackground")
      {
        location.reload();
      }
    });

    // Reset everything
  $("#closeOrdre").click(function(){
    location.reload();
  });

  // Try to load order from php. Handles
  // errors on its own.
  function last_ordre(ordrenr)
  {
    currentOrder = ordrenr;
    $.ajax({
      url: "./PHP/last_ordre.php",
      type: "POST",
      data: {orderNr: ordrenr},
      success: function (response) {
        console.log(response);
        var r = jQuery.parseJSON(response);
        console.log(r);
        if (r.success)
        {
          // Load information
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

          // Table row effects
          $("#ordrelinje").find("tr").each(function(){
            if ($(this).attr("id"))
            {
              var on = $(this).attr("id");
              on = on.slice(3);

              // Check if this item has been already returned,
              // before making it returnable
              hasService = false;
              index = 0;
              for (i = 0; i < r.servicelinje.length; i++)
              {
                if (on == r.servicelinje[i].artnr)
                {
                  hasService = true;
                  index = i;
                  break;
                }
              }
              if (hasService)
              {
                console.log("Found " + on + " in servicelinje.");
                if (r.servicelinje[index].type == "retur")
                {
                  $(this).find("td").each(function(){
                    $(this).addClass("tdRetur");
                  });
                }
                else if(r.servicelinje[i].type == "reklamasjon")
                {
                  $(this).find("td").each(function(){
                    $(this).addClass("tdReklamasjon");
                  });
                }
              }
              else
              {
                $(this).addClass("orderListRow");
                $(this).click(function(){

                  var index = jQuery.inArray(on, selectedOrders);
                  if (index == -1)
                  {
                    selectedOrders.push(on);
                    $(this).find("td").each(function(){
                      $(this).addClass("tdSelected");
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
              }
            }
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

  function service(type)
  {
    if (!selectedOrders.length)
    {
      popupError("Ingen artikler er valgt.");
      return;
    }

    var dataContainer = {
      ordrenr: currentOrder,
      items: selectedOrders,
      type: type
    };

    $.ajax({
      url: "./PHP/registrer_service.php",
      type: "POST",
      data: {data: dataContainer},
      success: function (response) {
        r = JSON.parse(response);
        console.log(r);
        if (r.success)
        {
          location.reload();
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        console.log("register service fail");
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
    });
  }
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
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
      }
    });
  });

  $("#submitArtNr").click(function() {
    popup.show();
    $("#artikkelsearch").show();
  });

  $("#ordreDetaljerReturBtn").click(function() {
    service("retur");
  });

  $("#ordreDetaljerReklamasjonBtn").click(function() {
    service("reklamasjon");
  });
});
