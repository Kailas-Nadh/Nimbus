<?php
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Replace with your own authentication logic
  $validCredentials = ($username === 'admin' && $password === 'password');

  if ($validCredentials) {
    $_SESSION['loggedIn'] = true;
    header('Location: personal_location.php');
  } else {
    $_SESSION['loggedIn'] = false;
    echo "Invalid username or password.";
  }
?>

