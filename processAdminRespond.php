<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: account.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

$adminMessageID = htmlentities($_GET['adminMessageID']);
	  
	 //DECODES THE VALUE
	  $adminMessageID= base64_decode($adminMessageID);
	  
	    //MULTIPLIES VALUE TO RANDOM VALUE
	  $adminMessageID = ($adminMessageID/$_SESSION['random']);
	  
  $message = $conn->real_escape_string($_POST['sendMessage']);

$query = "SELECT * FROM TrainerPal_AdminMessageHandler WHERE adminMessageID = '$adminMessageID'";

$result = $conn->query($query);
    if(!$result) {
    echo "did not work";
    }
    
  while($row=$result->fetch_assoc()){
     
  $sender = $row['senderID'];
  $subject = $row['subject'];

//$message = $conn->real_escape_string($_POST['sendMessage']);
//$subject = $conn->real_escape_string($_POST['subject']);

 
 $sendResponse= "INSERT INTO TrainerPal_AdminMessageReplies (adminID, originalMessageID, subject, response, recipientID)
                VALUES ('$activeID', '$adminMessageID','$subject', '$message', '$sender')"; 

$result = $conn->query($sendResponse);
    if(!$result) {
    echo "did not work";
    }
    else {
    
$updateQuery = "UPDATE TrainerPal_AdminMessageHandler SET responded = '2' WHERE adminMessageID = '$adminMessageID'";

$result = $conn->query($updateQuery);
    if(!$result) {
    echo "did not work";
    }
  header('Location: confirmedAdminResponse.php');
    }
    
    }
?>