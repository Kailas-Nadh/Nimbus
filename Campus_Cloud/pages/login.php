<?php      
        session_start();
        include('connection.php'); 
         
            $un=$_POST["username"];
   	    $pw=$_POST["password"]; 
          
            //to prevent from mysqli injection  
            $username = stripcslashes($un);  
            $password = stripcslashes($pw);  
            $username = mysqli_real_escape_string($con, $un);  
            $password = mysqli_real_escape_string($con, $pw);  
          
            $sql = "select username from users where username = '$un' and password = '$pw'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
              
            if($count > 0){ 
            	$_SESSION['session_username']=$un; 
                //echo "<h1><center> Login successful </center></h1>";  
  	        header('location: test.php');
            }  
            else{  
                echo "<h1> Login failed. Invalid username or password.</h1>"; 
                header('location: login.html');
            } 
?>
