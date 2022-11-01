// Disable form reloading page
$(document).ready(function(){
  $("form").submit(function(event){
    event.preventDefault();
  });
var loadCount = 0;

function requestDelivery()
{
  $("#loadback").load("./PHP/mottak_php.php", { newLoadCount: loadCount });
}

// Request delivery history
$("#mottakbtn").click(function(){
  // Show load more button if we haven't loaded anything yet
  if (!loadCount)
  {
    $("#loadMoreBtn").show();
  }
  loadCount += 2;
  requestDelivery();
});
$("#loadMoreBtn").click(function() {
  loadCount += 2;
  requestDelivery();
});
});
