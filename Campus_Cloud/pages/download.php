<?php
if(isset($_GET['path'])) {
  //Read the filename This line checks if the path parameter has been passed through the GET method.
  $filename = $_GET['path'];//gets the value of the path parameter and stores it in the $filename variable.

  //Check the file exists or not
  if(file_exists($filename)) {

    //Define header information These lines set the HTTP headers that will be sent to the client's browser to initiate the file download. 
    //They specify the file type, content length, and the file name to be used when saving the downloaded file.
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

    // Read the file and output it to the user 
    /*These lines prepare the file to be downloaded and send it to the client's browser for download.
    The ob_clean() function clears the output buffer to prevent any extraneous data from being sent to the browser. 
    The readfile() function reads the file and sends it to the browser, while 
    the flush() function ensures that all output is sent to the browser immediately. 
    Finally, exit() is called to terminate the script.*/
    ob_clean();
    flush();
    readfile($filename);
    exit();
  } 
  //These lines are executed if the file is not found at the specified location, 
  //in which case an error message is displayed. The $filename variable is echoed to help with debugging.
  else {
    // If the file does not exist, show an error message
    echo 'File not found.';
  }
  echo ($filename);
}
?>

