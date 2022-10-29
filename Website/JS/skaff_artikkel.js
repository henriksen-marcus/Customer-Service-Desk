
$(document).ready(function() {

  $("#searchBtn").click(function() {

    $("#errorField").html("");

    var navn = $("#navn").val();
    var pris = $("#pris").val();
    var kategori = $("#kategori").val();
    var beskrivelse = $("#beskrivelse").val();
    var hylleBokstav = $("#hylle").val().substr(0, 1);
    var hylleNr = $("#hylle").val().slice(1);
    var sort_by = $("#sorter").val();
    var sortOptn = $("#sortOptn").val();

    var hasInput = false;
    // Don't allow the user to submit an empty form
    $(".searchForm").find("input, textarea, select").each(function() {
      if ($(this).val() && $(this).attr("type") != "submit" &&
          $(this).attr("id") != "sorter" &&
          $(this).attr("id") != "sortOptn") {
        hasInput = true;
        return;
      }
    });

    if (!hasInput)
    {
      $("#errorField").html("Du må angi en verdi for å søke.");
      return;
    }

    $("#loadback").load("./PHP/skaff_artikkel.php", {
      navn: navn,
      pris: pris,
      kategori: kategori,
      beskrivelse: beskrivelse,
      hylleBokstav: hylleBokstav,
      hylleNr: hylleNr,
      sort_by: sort_by,
      sortOptn: sortOptn
    });
  });

});
