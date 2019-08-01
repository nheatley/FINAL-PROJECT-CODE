<?php  
session_start();
if(!isset($_SESSION['loggedSession'])) {
header('location: login.php');
}
$activeID = $_SESSION['loggedSession'];
include("connect.php");  
include('browserCheck.php'); 
  
    // SETTING THE INPUTS WHICH WERE STORED AS SESSION VARIABLES 
     $exerciseName = $_SESSION['exerciseName'];
     $workoutType = $_SESSION['workoutType'];
     $muscleGroup = $_SESSION['muscleGroup'];
     $description= $_SESSION['description'];
     $sets = $_SESSION['sets'];
     $reps = $_SESSION['reps'];
     $youtubeVideoURL = $_SESSION['youtubeVideoURL'];
  				       				       
        $insertquery= "INSERT INTO TrainerPal_Exercises (exerciseName, workoutType, muscleGroup, description, sets, reps, youtubeVideoURL) 
        	   VALUES ('$exerciseName', '$workoutType', '$muscleGroup', '$description', '$sets', '$reps', '$youtubeVideoURL')";
        
                $result = $conn->query($insertquery);
                     if(!$result){
                   echo "did not work";
                     } 
                     else {
                        
		echo " <p> Data has been added to your database.</p>";
                     header('Location: confirmedProcessExercise.php');
                }
	
?>
