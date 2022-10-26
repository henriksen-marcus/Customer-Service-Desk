
$(document).ready(function() {
  $("form").submit(function(event){
    event.preventDefault();
    var navn = $("#navn").val();
    var pris = $("#pris").val();
    var kategori = $("#kategori").val();
    var beskrivelse = $("#beskrivelse").val();
    var antall = $("#antall").val();
    var hylle = $("#hylle").val();

    $.ajax({
        url: "./PHP/last_siste.php",
        type: "POST",
        data: {
          navn: navn,
          pris: pris,
          kategori: kategori,
          beskrivelse: beskrivelse,
          antall: antall,
          hylle: hylle
        },
        success: function (result) {
            if (result[0] == "0")
            {
              // Remove the "0"
              $("#loadback").html(result.slice(1));
              $("#loadback").css("color", "red");
            }
            else
            {
              $("#resultContainer").add("p").html("Added to the database.").css("color", "green");
              $("#loadback").html(result);
            }
        }
    });
    // A simpler but less feauture-rich method:
    //$("#loadback").load("PHP/last_siste.php");
  });
});
