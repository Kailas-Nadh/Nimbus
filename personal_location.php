<?php
  session_start();
  if (!$_SESSION['loggedIn']) {
    header('Location: index.html');
  }
?>

<h1>Personal Location</h1>

<form action="upload.php" method="post" enctype="multipart/form-data">
  <label for="file">Select a file to upload:</label>
  <input type="file" id="file" name="file">
  <br><br>
  <input type="submit" value="Upload">
</form>

<br>

<a href="download.php">Download previously uploaded file</a>

<br><br>

<a href="logout.php">Logout</a>

