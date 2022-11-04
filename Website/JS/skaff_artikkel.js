
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

    var hylleNrStr = String(hylleNr);
    if (hylleNrStr > 3)
    {
      alert("Feil i hylle feltet. Må være en bokstav fulgt av tre sifre. F.eks (A001)");
      return;
    }
    else if (hylleNrStr.length == 2)
    {
      hylleNrStr = "0" + hylleNrString;
      hylleNr = Number(hylleNrStr);
    }
    else if (hylleNrStr.length == 1)
    {
      hylleNrStr = "00" + hylleNrString;
      hylleNr = Number(hylleNrStr);
    }
    console.log(hylleNr);

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
