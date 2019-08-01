<?php
session_start();
$userID = $_SESSION['loggedSession'];
if(!isset($_SESSION['loggedSession'])) {
header("location: trainerLogin.php");
}
include('connect.php');
include('browserCheck.php');
//INSERT QUERY TO MAKE RECORD THAT THE USER HAS ALREADY PAID FOR THE FEATURES
    $Update = "UPDATE TrainerPal_User SET upgradePaid = '2' WHERE userID = '$userID'";
    
         $result = $conn->query($Update);
                       if(!$result){
                       echo "did not work";
                       } else {
                       
         $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have just paid to upgrade your account with TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);        
      header("location: trainerRegister.php");
      }
      }
?>