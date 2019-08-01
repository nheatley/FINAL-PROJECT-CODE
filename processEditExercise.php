<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: login.php");
}

$activeID = $_SESSION['loggedSession'];

$exerciseID = htmlentities($_GET['exerciseID']);
  
    //DECODES THE VALUE
  $exerciseID= base64_decode($exerciseID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $exerciseID = ($exerciseID/$_SESSION['random']);  
   
 
include('connect.php');
include('browserCheck.php');
    
if (isset($_POST['exerciseNameSubButton'])) {

   $exerciseName = mysqli_real_escape_string($conn, $_POST['exerciseName']);

    $Update = "UPDATE TrainerPal_Exercises SET exerciseName = '$exerciseName' WHERE exerciseID = '$exerciseID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    
  //MULTIPLIES TO A RANDOM VALUE
  $exerciseID = ($exerciseID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $exerciseID= base64_encode($exerciseID); 
    
     header("location: editExercise.php?exerciseID=$exerciseID");
}


if (isset($_POST['descriptionSubButton'])) {

   $description = mysqli_real_escape_string($conn, $_POST['description']);

    $Update = "UPDATE TrainerPal_Exercises SET description = '$description' WHERE exerciseID = '$exerciseID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    
    //MULTIPLIES TO A RANDOM VALUE
  $exerciseID = ($exerciseID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $exerciseID= base64_encode($exerciseID);
  
   header("location: editExercise.php?exerciseID=$exerciseID");
}


if (isset($_POST['setsSubButton'])) {

   $sets = mysqli_real_escape_string($conn, $_POST['sets']);

    $Update = "UPDATE TrainerPal_Exercises SET sets = '$sets' WHERE exerciseID = '$exerciseID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
     
       //MULTIPLIES TO A RANDOM VALUE
  $exerciseID = ($exerciseID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $exerciseID= base64_encode($exerciseID);
     
    header("location: editExercise.php?exerciseID=$exerciseID");
}

if (isset($_POST['repsSubButton'])) {

   $reps = mysqli_real_escape_string($conn, $_POST['reps']);

    $Update = "UPDATE TrainerPal_Exercises SET reps = '$reps' WHERE exerciseID = '$exerciseID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    
      //MULTIPLIES TO A RANDOM VALUE
  $exerciseID = ($exerciseID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $exerciseID= base64_encode($exerciseID);
    
    header("location: editExercise.php?exerciseID=$exerciseID");
}

if (isset($_POST['youtubeVideoURLSubButton'])) {

  $youtubeVideoURL = $_SESSION['youtubeVideoURL'];

    $Update = "UPDATE TrainerPal_Exercises SET youtubeVideoURL = '$youtubeVideoURL' WHERE exerciseID = '$exerciseID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    
       //MULTIPLIES TO A RANDOM VALUE
  $exerciseID = ($exerciseID*$_SESSION['random']);
  
  //ENCODES THE RANDOM VALUE
  $exerciseID= base64_encode($exerciseID);
     
     header("location: editExercise.php?exerciseID=$exerciseID");
}

?>