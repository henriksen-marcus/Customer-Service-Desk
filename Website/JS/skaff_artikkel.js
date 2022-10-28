
$(document).ready(function() {

  $("form").submit(function(event){
    event.preventDefault();

    var navn = $("#navn").val();
    var pris = $("#pris").val();
    var kategori = $("#kategori").val();
    var beskrivelse = $("#beskrivelse").val();
    var hylleBokstav = $("hylleBokstav").val();
    var hylleNr = $("hylleNr").val();

    $("#loadback").load("./PHP/skaff_artikkel.php", {
      navn: navn,
      pris: pris,
      kategori: kategori,
      beskrivelse: beskrivelse,
      hylleBokstav: hylleBokstav,
      hylleNr: hylleNr
    });
  });

});
