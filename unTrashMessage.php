<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession']; 
include('connect.php');
include('browserCheck.php');

$messageID = htmlentities($_GET['messageID']);

      //DECODES THE VALUE
  $messageID= base64_decode($messageID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $messageID = ($messageID/$_SESSION['random']);  
   
    $Update = "UPDATE TrainerPal_MessageHandler SET inTrash = '1' WHERE messageID = '$messageID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));

       if(!$UpdateResult) {
    echo "did not work";
    }
    
    header("location: confirmedUnTrashMessage.php");
    
?>