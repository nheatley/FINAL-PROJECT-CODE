<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');


// QUERY WHICH INSERTS THE RESET PASSWORD INTO THE USER TABLE 

 $passw = $conn->real_escape_string($_POST['password']);
  
 $insertChangedPassword = "UPDATE TrainerPal_User SET password= AES_ENCRYPT ('$passw', '3') WHERE userID ='$activeID'";
 
       $result = $conn->query($insertChangedPassword);
                       if(!$result){
                       echo $conn->error;
                       
                       header('Location: enterChangedPassword.php');
                        } else {
                        
                        echo " <p> Password Changed Successfully</p>";
                        header('Location: confirmedPasswordChange.php');
                
                       }

?>