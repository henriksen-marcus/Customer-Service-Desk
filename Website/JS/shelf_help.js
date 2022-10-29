
// Help user get the right hylle
function updateHylleVal() {
  var currentCat = $("#kategori").val();
  if (!currentCat) { return; }
  var val = $("#hylle").val();
  var categories = ["A", "B", "C", "D", "E", "F", "G", "H"];

  // Remove the category character
  for (var i = 0; i < categories.length; i++)
  {
    if (val.toUpperCase().includes(categories[i]))
    {
      var index = val.toUpperCase().search(categories[i]);
      val = val.substr(0, index - 1) + val.substr(index + 1, val.length - 1);
    }
  }

  var newVal = currentCat.concat(val);
  $("#hylle").val(newVal);
}

$(document).ready(function(){
  $("#hylle").keyup(function() {
    // Allow the user to empty the field
    if ($("#hylle").val() == "") { return; }
    updateHylleVal();
  });

  $("#kategori").change(function() {
    updateHylleVal();
  });
});
