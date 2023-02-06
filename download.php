/*This code will first check if a specific file has been requested for download (through the $_GET['file'] variable). If a file has been requested, it will check if the file exists and, if it does, will trigger a download for the user. If no specific file has been requested, it will show a list of all the files in the personal_location/ directory, with links for each file that will trigger a download when clicked. */

<?php
  session_start();
  if (!$_SESSION['loggedIn']) {
    header('Location: index.html');
  }

  $username = $_SESSION['username'];
  $personal_location = "personal_locations/$username/";

  if (isset($_GET['file'])) {
    $file = $personal_location . $_GET['file'];

    if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($file).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      readfile($file);
      exit;
    } else {
      echo "File not found.";
    }
  } else {
    if ($handle = opendir($personal_location)) {
      while (($file = readdir($handle)) !== false) {
        if (!in_array($file, array('.', '..'))) {
          echo "<a href='download.php?file=$file'>$file</a><br>";
        }
      }
      closedir($handle);
    }
  }
?>

