<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('browserCheck.php');
include('connect.php');

$activeID = $_SESSION['loggedSession'];

    //CLIENT ID CARRIED OVER TO THIS PAGE
      $clientID = htmlentities($_GET['clientID']);
      
  //DECODES THE VALUE
  $clientID= base64_decode($clientID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $clientID = ($clientID/$_SESSION['random']);


    // UDATES THE DATABASE TO SHOW THAT THE REQUEST HAS BEEN ACCEPTED
    $Update = "UPDATE TrainerPal_TrainerRequests SET trainerRequestResponse = '3' WHERE trainer = '$activeID' AND client = '$clientID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));

    if(!$UpdateResult) {
    echo "did not work";
    }
    
    // INSERTS INTO THE TRAINER CLIENT TABLE THE NECESSARY DATA
    
    $acceptRequest = "INSERT INTO TrainerPal_TrainerClients (trainer, client) VALUES ('$activeID', '$clientID')";
    $acceptResult = mysqli_query($conn, $acceptRequest) or die(mysqli_error($conn));
    
    if(!$acceptResult) {
    echo "did not work";
    } else {
       
    // SELECT QUERY TO GET THE EMAIL ADDRESS OF THE USER THAT HAS BEEN VERIFIED   
    $get = "SELECT * FROM TrainerPal_User WHERE userID = '$clientID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "Your Trainer Request was ACCEPETED within TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

                    // SENDS NOTIFICATION EMAIL 
					mail($to,$subject,$txt,$headers); 
					
    //QUERY WORKED THEREFORE USER IS DIRECTED TO A CONFIRMATION PAGE
    header("location: confirmedAcceptTrainerRequest.php");
    }
    }
?>