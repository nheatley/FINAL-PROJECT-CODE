<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: account.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
$message = $conn->real_escape_string($_POST['sendMessage']);

  $userID = htmlentities($_GET['userID']);

      //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  
 
 $requestCheck= "SELECT * FROM TrainerPal_TrainerRequests WHERE trainer = '$userID' AND client = '$activeID' AND trainerRequestResponse ='1'";
 
 $result = $conn->query($requestCheck);
    if(!$result) {
    echo "did not work";
    } 
    $num = $result -> num_rows;

if ($num == 0) {

 
$sendMessage= "INSERT INTO TrainerPal_TrainerRequests (trainer, message, client, trainerRequestResponse) VALUES 
               ('$userID', '$message', '$activeID', '1')"; 

$result = $conn->query($sendMessage);
    if(!$result) {
    echo "did not work";
    }
    else {
    
    $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have a new Trainer Request in TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);        
    
  header('Location: confirmedRequestTrainer.php');
    }
    }
    } else {
    header('Location: trainerRequestError.php');
    }
?>