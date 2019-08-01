<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession']; 
include('connect.php');
include('browserCheck.php');

   $userID = htmlentities($_GET['userID']);
  
  //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  
  
   $deleteQuery = $conn->query("DELETE FROM TrainerPal_TrainerClients WHERE trainer = '$userID' AND client = '$activeID'");

     if(!$deleteQuery) {
    echo "did not work";
    } else {
    header('Location: confirmedRemoveTrainer.php');
    }
?>