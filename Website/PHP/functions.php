<?php
  // Safety check as well as removing unnecessary chars
  function processData($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  function printTable($link, $result)
  {
    if (mysqli_num_rows($result) < 1)
    {
      return;
    }

    $fields = $result->fetch_fields();
    $cols = mysqli_field_count($link);

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
      $data = $rad[0];
      echo "<tr id='php$data'>";
      for ($i = 0; $i < $cols; $i ++)
      {
        echo "<td>$rad[$i]</td>";
      }
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }


  function fetchTable ($link, $result)
  {
    if (mysqli_num_rows($result) < 1)
    {
      return;
    }

    $fields = $result->fetch_fields();
    $cols = mysqli_field_count($link);

    $return = "";

    $return = $return . "<table>";
    $return = $return . "<thead>";

    $loops = 0;
    // Print the first row (name of columns)
    while ($loops < $cols)
    {
      $nameStr = ucfirst($fields[$loops]->name);
      $return = $return . "<th>$nameStr</th>";
      $loops++;
    }
    $return = $return . "</thead>";
    $return = $return . "<tbody>";

    while ($rad = mysqli_fetch_row($result))
    {
      $data = $rad[0];
      $return = $return . "<tr id='php$data'>";
      for ($i = 0; $i < $cols; $i ++)
      {
        $return = $return . "<td>$rad[$i]</td>";
      }
      $return = $return . "</tr>";
    }
    $return = $return . "</tbody>";
    $return = $return . "</table>";

    return $return;
  }
?>
