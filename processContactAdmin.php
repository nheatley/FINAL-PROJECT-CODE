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


//TAKES THE ENCRYPTED PASSWORD OUT OF THE DATABASE AND DECRYPTS IT IN ORDER TO COMPARE WITH THE ENTERED LOGIN DATA
 
 $sendMessage= "INSERT INTO TrainerPal_AdminMessageHandler (senderID, subject, message, responded)
                VALUES ('$activeID', '$subject', '$message', '1')"; 

$result = $conn->query($sendMessage);
    if(!$result) {
    echo "did not work";
    }
    else {
  header('Location: confirmedContactAdmin.php');
    }
      
?>