<?php
  session_start();
  if (!$_SESSION['loggedIn']) {
    header('Location: index.html');
  }

  $username = $_SESSION['username'];
  $personal_location = "personal_locations/$username/";
  if (!file_exists($personal_location)) {
    mkdir($personal_location, 0777, true);
  }

  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
    $file = $personal_location . $_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"], $file);
    echo "File uploaded successfully.";
  }
?>

