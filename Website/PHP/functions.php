<?php
  // Safety check as well as removing unnecessary chars
  function processData($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
