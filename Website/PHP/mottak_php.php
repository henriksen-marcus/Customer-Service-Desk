<?php
require_once 'connect.php';
require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css"/>
    <meta charset="utf-8">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
      integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
      crossorigin="anonymous">
    </script>
<script>
  $(document).ready(function(){
    var mottakcount = 2;
    $("eldremottakbtn").click(function(){
      mottakcount = mottakcount + 2;
      $("#mottakbox").load("eldremottak.php", {
        mottaknewcount: mottakcount;

      });
    })
  });
</script>

  </head>
  <body>
    <div class="backContainer">
      <button class="backBtn" onclick="window.location.href='http://localhost/Website/mottak.html';">< Tilbake</button>
    </div>
    <a href="http://localhost/Website/">
      <img id="logo" src="https://i.imgur.com/oyQFzWx.png">
    </a>
    <div id="mottakbox">
      <?php
      $sql = "SELECT * FROM mottak LIMIT 2";
      $result = mysqli_query($link, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<p>";
          $row['Mottaklinje'];
          echo "<br>";
          $row['SumVarer'];
          echo "<br>";
          $row['Dato'];
          echo "<br>";
          echo "</p>";
        }
      }else {
        echo "Nothing here but you";
      }
      ?>
    </div>
  <button id="eldremottakbtn" name="eldremottak" style="margin-top: 5px">Last inn eldre mottak</button>

  </body>
</html>
