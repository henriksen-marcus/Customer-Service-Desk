<?php
  // Load the specified number of rows from the table 'mottak'

  include 'connect.php';

  if (isset($_POST["newLoadCount"]))
  {
    $newLoadCount = $_POST["newLoadCount"];

    $sql = "SELECT * FROM mottak LIMIT $newLoadCount";
    $result = mysqli_query($link, $sql);
    $cols = mysqli_field_count($link);
    if (mysqli_num_rows($result) > 0) {

      $fields = $result->fetch_fields();

      echo "<table>";
      echo "<thead>";

      $loops = 0;
      // Print the first row (name of columns)
      while ($loops < $cols)
      {
        $nameStr = ucfirst($fields[$loops]->name);
        echo "<th>$nameStr</th>";
        $loops++;
      }
      echo "</thead>";
      echo "<tbody>";

      while ($rad = mysqli_fetch_row($result))
      {
        echo "<tr>";
        for ($i = 0; $i < $cols; $i ++)
        {
          echo "<td>$rad[$i]</td>";
        }
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";

      if (mysqli_num_rows($result) < $newLoadCount)
      {
        echo "<p>Ingen flere mottak.</p>";
      }
    }
    else
    {
      echo "Ingen mottak funnet!";
    }
  }
?>
