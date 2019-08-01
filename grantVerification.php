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

//SELECTS THE USER ID RELEVANT TO THAT PARTICLAR VERIFICATION REQUEST

 $query = "SELECT TrainerPal_User.userID FROM TrainerPal_User INNER JOIN TrainerPal_Verifications ON
           TrainerPal_User.userID = TrainerPal_Verifications.userID WHERE TrainerPal_Verifications.verificationID = '$verificationID'";
 
 $queryResult = mysqli_query($conn, $query) or die(mysqli_error($conn));
 
    if(!$queryResult) {
    echo "did not work";
    }
 
   while($row=$queryResult->fetch_assoc()){

  //GETS THE USER ID
  $userID = $row['userID'];
  
  $Update1 = "UPDATE `TrainerPal_Trainer` SET `verified` = '2' WHERE `TrainerPal_Trainer`.`userID` = '$userID'";
    $UpdateResult1 = mysqli_query($conn, $Update1) or die(mysqli_error($conn));

    if(!$UpdateResult1) {
    echo "did not work";
    } 

    else {
    
            
    $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have been VERIFIED as a Trainer with TrainerPal: Health & Fitness.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);   
    
    }
 
    // UPDATES THE VERIFICATIONS TABLE TO SHOW THAT THE ADMIN HAS RESPONDED
    
    $Update = "UPDATE `TrainerPal_Verifications` SET `adminResponded` = '2' WHERE `TrainerPal_Verifications`.`verificationID` = '$verificationID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));

       if(!$UpdateResult) {
    echo "did not work";
     header("location: adminHome.php");
    }
    header("location: confirmedVerificationGranted.php");
   }
   }
    
?>