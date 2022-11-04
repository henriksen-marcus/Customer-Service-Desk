$(document).ready(function() {

  var divs =
  [
    {b: $("#ordreIdDropDown"), open: true},
    {b: $("#kundeDropDown"), open: false},
    {b: $("#utenKvitteringDropDown"), open: false}
  ];

  var closed_height = "50px";
  var open_height = "200px";

  divs[0].b.click(function(){

    if (divs[0].open)
    {
      divs[0].b.parent().css("max-height", closed_height);
      divs[0].open = false;
    }
    else {
      divs[0].b.parent().css("max-height", open_height);
      divs[0].open = true;
      divs[1].b.parent().css("max-height", closed_height);
      divs[1].open = false;
      divs[2].b.parent().css("max-height", closed_height);
      divs[2].open = false;
    }
  });

  divs[1].b.click(function(){
    if (divs[1].open)
    {
      divs[1].b.parent().css("max-height", closed_height);
      divs[1].open = false;
    }
    else {
      divs[1].b.parent().css("max-height", open_height);
      divs[1].open = true;
      divs[0].b.parent().css("max-height", closed_height);
      divs[0].open = false;
      divs[2].b.parent().css("max-height", closed_height);
      divs[2].open = false;
    }
  });

  divs[2].b.click(function(){
    if (divs[2].open)
    {
      divs[2].b.parent().css("max-height", closed_height);
      divs[2].open = false;
    }
    else {
      divs[2].b.parent().css("max-height", open_height);
      divs[2].open = true;
      divs[0].b.parent().css("max-height", closed_height);
      divs[0].open = false;
      divs[1].b.parent().css("max-height", closed_height);
      divs[1].open = false;
    }
  });

});
