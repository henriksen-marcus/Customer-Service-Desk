$(document).ready(function() {

  var ordreNrBtn = $("#b1");
  var tlfNrBtn = $("#b2");
  var artNrBtn = $("#b3");

  var ordreNrOpen = false;
  var tlfNrOpen = false;
  var artNrOpen = false;

  var closed_height = "50px";
  var open_height = "200px";

  function p(div) { return div.parent().parent(); }

  // Opens the passed image's container and closes the rest
  function openDiv(div)
  {
    // Close all container divs
    $("#wrapper").find(".DropDownContainer").each(function() {
      $(this).css("max-height", closed_height);
      $(this).find("img").css("transform", "rotate(0deg)");
    });

    p(div).css("max-height", open_height);
    div.css("transform", "rotate(180deg)");
  }

  function closeDiv(div)
  {
    p(div).css("max-height", closed_height);
    div.css("transform", "rotate(0deg)");
  }

  ordreNrBtn.click(function() {
    if (ordreNrOpen)
    {
      closeDiv($(this));
      ordreNrOpen = false;
    }
    else
    {
      openDiv($(this));
      ordreNrOpen = true;
    }
  });

  tlfNrBtn.click(function() {
    if (tlfNrOpen)
    {
      closeDiv($(this));
      tlfNrOpen = false;
    }
    else
    {
      openDiv($(this));
      tlfNrOpen = true;
    }
  });

  artNrBtn.click(function() {
    if (artNrOpen)
    {
      closeDiv($(this));
      artNrOpen = false;
    }
    else
    {
      openDiv($(this));
      artNrOpen = true;
    }
  });

});
