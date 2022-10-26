<?php
  // Laster siste line som ble lagt til i produktliste.

  include 'connect.php';

  $sql = "SELECT * FROM Produktliste LIMIT 1;";
  $resultat = mysqli_query($link, $sql);

  // Get number of columns in the table
  // NOTE: This will only work after a query,
  // else mysqli doesn't know which table to use.
  $cols = mysqli_field_count($link);

  if (mysqli_num_rows($resultat) > 0)
  {
    echo "<table>";
    $fields = $resultat->fetch_fields();
    while ($rad = mysqli_fetch_row($resultat))
    {
      $loops = 0;
      echo "<thead>";
      while ($loops < $cols)
      {
        // Print name of column
        $nameStr = ucfirst($fields[$loops]->name);
        echo "<th>$nameStr</th>";
        $loops++;
      }
      echo "</thead>";

      $loops = 0;
      echo "<tbody>";
      echo "<tr>";
      while ($loops < $cols)
      {
        echo "<td>$rad[$loops]</td>";
        $loops++;
      }
      echo "</tr>";
      echo "</tbody>";
      echo "</table>";
    }
  }
  else
  {
      echo 0;
      echo "<p>Could not load database result. No rows returned.</p>";
  }
?>
