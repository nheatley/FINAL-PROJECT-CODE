<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');
include('browserCheck.php');

 $trainerRequestID = htmlentities($_GET['trainerRequestID']);

   //DECODES THE VALUE
  $trainerRequestID= base64_decode($trainerRequestID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $trainerRequestID = ($trainerRequestID/$_SESSION['random']);  


$activeID = $_SESSION['loggedSession'];

$resultB = $conn->query("DELETE FROM TrainerPal_TrainerRequests WHERE trainerRequestID = '$trainerRequestID' AND client = '$activeID'");

    if(!$resultB) {
    echo "did not work";
    } else {
    header('location: confirmedCancelRequest.php');
    }

?>