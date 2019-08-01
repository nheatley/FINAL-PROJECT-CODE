<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: account.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
$message = $conn->real_escape_string($_POST['sendMessage']);
$subject = $conn->real_escape_string($_POST['subject']);

 $userID = htmlentities($_GET['userID']);
 
      //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  


//TAKES THE ENCRYPTED PASSWORD OUT OF THE DATABASE AND DECRYPTS IT IN ORDER TO COMPARE WITH THE ENTERED LOGIN DATA
 
 $sendMessage= "INSERT INTO TrainerPal_MessageHandler (senderID, subject, message, recipientID, messageRead, inTrash) VALUES ('$activeID', '$subject', '$message', '$userID', '1', '1')"; 

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
					$txt = "You have a NEW MESSAGE in TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers); 
  header('Location: confirmedContactTrainer.php');
    }
    }
    
?>