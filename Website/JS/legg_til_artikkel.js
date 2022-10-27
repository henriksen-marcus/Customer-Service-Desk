
$(document).ready(function() {
  $("form").submit(function(event){
    event.preventDefault();

    $('form').children("input, textarea, select").each(function () {
        $(this).css("color", "black");
    });

    var navn = $("#navn").val();
    var pris = $("#pris").val();
    var kategori = $("#kategori").val();
    var beskrivelse = $("#beskrivelse").val();
    var antall = $("#antall").val();
    var hyllebokstav = $("#hylle").val().substr(0, 1);
    var hyllenr = $("#hylle").val().slice(1);

    $.ajax({
        url: "./PHP/legg_til_artikkel.php",
        type: "POST",
        data: {
          navn: navn,
          pris: pris,
          kategori: kategori,
          beskrivelse: beskrivelse,
          antall: antall,
          hyllebokstav: hyllebokstav,
          hyllenr: hyllenr
        },
        success: function (result) {
          console.log(result);
            if (result[0] == "1")
            {
              $("#resultContainer").add("p").html("Lagt til i databasen.").css("color", "green");
              $.ajax({
                  url: "./PHP/last_siste.php",
                  type: "POST",
                  success: function (result) {
                      if (result[0] == "0")
                      {
                        // Remove the "0"
                        $("#loadback").html(result.slice(1));
                        $("#loadback").css("color", "red");
                      }
                      else
                      {
                        $("#loadback").html(result);
                      }
                  }
              });
              $("form")[0].reset();
              // A simpler but less feauture-rich method:
              //$("#loadback").load("PHP/last_siste.php");
            }
            else if(result[0] == "0")
            {
              var returnArr = JSON.parse(result.slice(1));
              var i = 0;
              $('form').children("input, textarea, select").each(function () {
                if (returnArr[i])
                {
                  $(this).css("color", "red");
                }
                i++;
              });
            }
            else
            {
              $("#loadback").html(result);
              $("#loadback").css("color", "red");
            }
        }
    });
  });
});
