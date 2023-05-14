<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Nimbus</title>
	<link rel="stylesheet" type="text/css" href="test.css">
	<script type="text/javascript" src="scripts.js"></script> 
</head>
<body bgcolor="#5A697B">
	
	<div class="fixed-header">
		<div class="rectangle1"></div>
		<div class="rectangle2"></div>
		<div class="circle"></div>
		<div class="rectangle-form"></div>
	</div>
	<?php  
        session_start();
        require_once "databaseConnection.php";
        $username=$_SESSION['session_username'];
        echo '<label id="username">'.$username.'</label>';
    ?>
    
	<div class="container">
			<form action="test.php" method="post">
			<button type="submit" name="logout" id="logout">Logout</button>
			<!--<button type="submit" name="settings" id="settings">SETTINGS</button>-->
			<button type="submit" name="change_pswd" id="change_pswd">Change Password</button>
			<button type="submit" id="uploadButton"  name="upload_files"">Upload Files</button>
			<button type="submit" id="viewButton"  name="view_files"">View Files</button>
			<img class="View" src="viewImage.svg" alt="View">
			<img class="Upload" src="uploadImage.svg" alt="Upload">
			<img class="UserImage" src="profilePic.svg" alt="User">
			</form>
	</div>
	
	<?php

        if(isset($_POST["logout"]))
        {   
            $_SESSION['session_username']=' ';
            header("location:login.php");
        }
        //if(isset($_POST["change_pswd"]))
	//{   
    	//	header("location:Pswd.html");
	//}

        if(isset($_POST["upload_files"]))
        {   
            $format = '<form action="test.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="file_name" id="file_name" required><br>
                        <button id="upload_btn" type="submit" name="file_upload">UPLOAD</button> 
                        </form>';
            echo $format;
        }
        ?>
        <div style="position: fixed;width: 320px;height: 48px;right: calc(50% - 136px/2 + 140px);top: 560px;color: #EFEFEF;font-size: 24px;">
        <?php
        if(isset($_POST["view_files"]))
        {   
            // $format = '<form action="files.php" method="post" enctype="multipart/form-data">
            //             <h2>NO FILE</h2>
            //             </form>';
            // echo $format;

            $sql = "SELECT filename FROM files where username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $i = 1;
                //echo '<h2>ALL FILES</h2><br>';
                while($row = $result->fetch_assoc()) {
                    
                    echo '<form action="test.php" method="post" enctype="multipart/form-data">';
                    $button_id = 'view-button';
  		   echo "File".$i.": " .substr($row["filename"],10)."<br><button id='" . $button_id . "'><a href='mnt/".$username."/".$row["filename"]."' target='_blank'>View</a></button>";
  		   $button_id = 'download-button';
                    echo '<button id="' . $button_id . '"><a href="download.php?path=mnt/'.$username.'/'.$row["filename"].'" target="_blank">Download</a></button>';
                    $button_id = 'delete-button';
                    echo '<button id="' . $button_id . '" type="submit" name="file_delete" value="'.$row["filename"].'">Delete</button>';
                    
                    echo '</form>';
                    $i++;
                }
            } 
            else {
                echo "0 results";
            }
        }
        

        if(isset($_POST["file_upload"]))
        {   
            $oldfilename=$_FILES['file_name']['name'];
            $newfilename=time().$oldfilename;
            $oldfilelocation=$_FILES['file_name']['tmp_name'];

            if(file_exists("mnt/".$username)){
                $status=1;//not used in coding
            }
            else{
                mkdir("mnt/".$username);
            }
            move_uploaded_file($oldfilelocation,"mnt/".$username."/".$newfilename);
            $sql = "insert into files values('$username','$newfilename');";
            $result = $conn->query($sql);
  	    echo '<div style="position: fixed;width: 200px;height: 48px;left: calc(50% - 136px/2 + 140px);top: 560px;color: #EFEFEF;font-size: 24px;">File Uploaded...</div>';
            // if ($conn->query($sql) === TRUE) {
            //         echo "New record created successfully";
            // } else {
            //         echo "Error: " . $sql . "<br>" . $conn->error;
            // }
        }

        if(isset($_POST["file_delete"]))
        {   
            $filename=$_POST["file_delete"];
            $sql = "DELETE FROM files WHERE filename='$filename';";
            $result = $conn->query($sql);
            $status=unlink("mnt/".$username."/".$_POST["file_delete"]);    
            if($status){  
                echo "File deleted successfully";    
            }//else{  
               // echo "Sorry!";    
            //}  
            
        }
        /*if(isset($_POST["settings"]))
        {   
            $format = '<div>
                    <form action="test.php" method="post" enctype="multipart/form-data">
                        <br>
                        <button type="submit" name="change_password" id="change_password">CHANGE PASSWORD</button>
                    </form>
                    </div>';
            echo $format;
        }*/
//<div style="position: fixed;width: 320px;height: 48px;right: calc(50% - 136px/2 + 140px);top: 560px;color: #EFEFEF;font-size: 24px;">
//This line checks if the "change" button was clicked in the form, indicating that the user wants to change their password.
        if(isset($_POST["change_pswd"]))
        {   
            $format = '<div>
                        <form action="test.php" method="post" enctype="multipart/form-data">
                        <h3 style="height: 20px; width: 500px; text-align: left; color: #B2BEB5">CHANGE PASSWORD</h3><br>
			Currect Password:<input type="password" id="currect_password" name="currect_password" required><br>
			New Password:<input type="password" id="new_password" name="new_password" required><br>
			Confirm Password:<input type="password" id="confirm_password" name="confirm_password" required><br><br>
		        <button type="submit" name="change" id="change" onclick="confirm_password()">CHANGE</button>
		        <style>
    input[type=password] {
      width: 374px;
  	height: 48px;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 17px;
      box-sizing: border-box;
      font-style: normal;
      font-family: Roboto;
  font-weight: 300;
  font-size: 24px;
  line-height: 28px;
    }

    button[type=submit][name=change] {
      background-color: #3575C2;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 374px;
  	height: 48px;
	left: calc(50% - 238px/2);
	top: 670px;
	border-radius: 17px;
	font-family: Poppins;
	font-style: normal;
	font-weight: 600;
	font-size: 24px;
	line-height: 28px;
	color: #EFEFEF;
	border: 0.2px solid #3575C2;
	cursor: pointer;
    }

    button[type=submit]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      font-size: 14px;
    }

    h3 {
      width: 200px;
      height: 50px;
      text-align: center;
      color: #5678A2;
    }
    .button-container {
      text-align: center;
    }
</style>
                   </div>';
            echo $format;
        }
//This line checks if the "change" button was clicked in the form, indicating that the user wants to change their password.
        if(isset($_POST["change"]))
        { 
//retrieve the values of the "current password", "new password", and "confirm password" fields from the form submission.            
		$curp=$_POST["currect_password"];
            $newp=$_POST["new_password"];
            $conp=$_POST["confirm_password"];
//This SQL query retrieves the current password of the user from the database, based on their username.
            $sql = "select password from users where username='$username';";
            $result = $conn->query($sql);
  //If there is a result from the SQL query (i.e. the user was found in the database), this code retrieves the password from the result and stores it in a variable called $old_password          
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $old_password = $row["password"];
              }
            }
//If the current password entered by the user does not match the old password retrieved from the database, an error message is displayed using a JavaScript alert.
            if($curp != $old_password) {
                echo '<script type="text/javascript">';
                echo 'alert("Old Password Not Match")';
                echo '</script>';
            }
            else if($curp == $newp)  {
                echo '<script type="text/javascript">';
                echo 'alert("New Password Must Not Match With Old Password")';
                echo '</script>';
            }
            else if($conp != $newp)  {
                echo '<script type="text/javascript">';
                echo 'alert("Password Not Confirmed")';
                echo '</script>';
            }
            else {
                $sql = "UPDATE users SET password='$newp' where username='$username';";
                if ($conn->query($sql) === TRUE) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Password Changed")';
                    echo '</script>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
           
        }
    ?>
    </div>
</body>
</body>
</html>
