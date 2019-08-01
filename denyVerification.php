<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession']; 
include('connect.php');
include('browserCheck.php');

  $verificationID = htmlentities($_GET['verificationID']);
 
  //DECODES THE VALUE
  $verificationID= base64_decode($verificationID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $verificationID = ($verificationID/$_SESSION['random']);
  

    $Update = "UPDATE `TrainerPal_Verifications` SET `adminResponded` = '2' WHERE `TrainerPal_Verifications`.`verificationID` = '$verificationID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));

       if(!$UpdateResult) {
    echo "did not work";
    }
    else {
    
     $get = "SELECT TrainerPal_User.userID, TrainerPal_User.email FROM TrainerPal_User INNER JOIN TrainerPal_Verifications
             ON TrainerPal_User.userID = TrainerPal_Verifications.userID WHERE TrainerPal_Verifications.verificationID = '$verificationID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have been DENIED Trainer Verification from TrainerPal: Health & Fitness. Please try again.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);        
    header("location: confirmedDeniedVerification.php");
    }
    }
?>