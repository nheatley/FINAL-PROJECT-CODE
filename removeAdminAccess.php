<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}

$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

 $userID = htmlentities($_GET['userID']);
 
      //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  
  
  /// QUERY TO GET DETAILS OF THE USER ACCOUNT
  $result = $conn->query("DELETE FROM TrainerPal_Admins WHERE userID = '$userID' ");
  
    if(!$result) {
    echo "did not work";
    } else {
    
    $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "Your Admin Access has been removed from TrainerPal: Health & Fitness.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);        
    
     header("location: confirmedAdminRemoval.php");
    }
    }
?>