<?php  
session_start();
if(!isset($_SESSION['loggedSession'])) {
header('location: login.php');;
}

$activeID = $_SESSION['loggedSession'];
include("connect.php");   
include('browserCheck.php');
  
   //STILL CARRYING THE ORIGINAL CLIENT USER ID
    $userID = $_SESSION['clientID'];
    
    // SETTING THE INPUTS WHICH WERE STORED AS SESSION VARIABLES 
     $exerciseName = $_SESSION['exerciseName'];
     $workoutType = $_SESSION['workoutType'];
     $muscleGroup = $_SESSION['muscleGroup'];
     $description= $_SESSION['description'];
     $sets = $_SESSION['sets'];
     $reps = $_SESSION['reps'];
     $youtubeVideoURL = $_SESSION['youtubeVideoURL'];
  				       				       
        $insertquery= "INSERT INTO TrainerPal_TrainerClientWorkouts (exerciseName, workoutType, muscleGroup, description, sets, reps, youtubeVideoURL, clientID, trainerID, workoutCompleted) 
        	   VALUES ('$exerciseName', '$workoutType', '$muscleGroup', '$description', '$sets', '$reps', '$youtubeVideoURL', '$userID', '$activeID', '1')";
        
                $result = $conn->query($insertquery);
                     if(!$result){
                   echo "did not work";
                     } 
                     else {
                     
                     $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have a new assigned workout from your TrainerPal Trainer, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);        
                        
		echo " <p> Data has been added to your database.</p>";
                     header('Location: confirmedSendWorkout.php');
                }
                }
	
?>
