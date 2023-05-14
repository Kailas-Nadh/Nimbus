<?php
if(isset($_GET['path'])) {
  //Read the filename
  $filename = $_GET['path'];

  //Check the file exists or not
  if(file_exists($filename)) {

    //Define header information
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

    // Read the file and output it to the user
    ob_clean();
    flush();
    readfile($filename);
    exit();
  } else {
    // If the file does not exist, show an error message
    echo 'File not found.';
  }
  echo ($filename);
}
?>

