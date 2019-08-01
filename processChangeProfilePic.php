<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: login.php");
}

$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

   /*
 	* PROCESS THE NEW EDIT DETAILS INPUTS AND UPDATES THE DATABASE
 	*/
 	
     $profileImage = mysqli_real_escape_string($conn, $_POST['finput']);
   
   if ($_FILES['finput']['name'] != null) {
     
     $profileImage = $_FILES["finput"]["name"];
     
     $img_path =  $_FILES["finput"]["tmp_name"];
     
    move_uploaded_file($img_path, "uploadedfiles/".$profileImage);

    $Update = "UPDATE TrainerPal_User SET profilePictureURL = '$profileImage' WHERE userID = '$activeID'";
    
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    
     header("location: editDetails.php");
     
     }
?>