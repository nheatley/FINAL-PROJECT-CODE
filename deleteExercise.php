<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
 
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

  //CARRIES THE EXERCISE ID
  $exerciseID = htmlentities($_GET['exerciseID']);

  //DECODES THE VALUE
  $exerciseID= base64_decode($exerciseID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $exerciseID = ($exerciseID/$_SESSION['random']);
  
   // QUERY DELETES FROM THE TrainerPal_User Table
    $deleteQuery= "DELETE FROM TrainerPal_Exercises WHERE exerciseID = '$exerciseID'";
    $result = $conn->query($deleteQuery);
    if(!$result) {
    echo "did not work";
    }
    header("location: confirmExerciseDelete.php");
?>