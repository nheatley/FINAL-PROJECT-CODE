<?php 
session_start();
$emailAddress = $_SESSION['emailAddress'];
include("connect.php");
include('browserCheck.php');


// QUERY WHICH INSERTS THE RESET PASSWORD INTO THE USER TABLE 

 $passw = $conn->real_escape_string($_POST['password']);
  
 $insertResetPassword = "UPDATE TrainerPal_User SET password= AES_ENCRYPT ('$passw', '3') WHERE email ='$emailAddress'";
 
       $result = $conn->query($insertResetPassword);
                       if(!$result){
                       echo $conn->error;
                       
                       header('Location: index.php');
                        } else {
                        	$_SESSION['passwordChange'] = 2 ;
                        echo " <p> Password Changed Successfully</p>";
                        header('Location: login.php');
                
                       }

?>