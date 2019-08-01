<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');

$activeID = $_SESSION['loggedSession'];

  $trainerRequestID = htmlentities($_GET['trainerRequestID']);

  //DECODES THE VALUE
  $trainerRequestID= base64_decode($trainerRequestID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $trainerRequestID = ($trainerRequestID/$_SESSION['random']);
  

    $Update = "UPDATE TrainerPal_TrainerRequests SET trainerRequestResponse = '2' WHERE trainerRequestID = '$trainerRequestID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));

       if(!$UpdateResult) {
    echo "did not work";
    } else {
        
    $get = "SELECT TrainerPal_User.email FROM TrainerPal_User INNER JOIN TrainerPal_TrainerRequests ON 
            TrainerPal_User.userID = TrainerPal_TrainerRequests.client WHERE TrainerPal_TrainerRequests.trainerRequestID = '$trainerRequestID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "Your Trainer Request has been DENIED with TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers); 
    header("location: confirmedDenyTrainerRequest.php");
}
}
?>