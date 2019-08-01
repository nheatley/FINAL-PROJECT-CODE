<?php  
session_start();
if(!isset($_SESSION['loggedSession'])) {
header('location: login.php');
}
$activeID = $_SESSION['loggedSession'];
include("connect.php");   
  include('browserCheck.php');
  
    $rating = $conn->real_escape_string($_POST['rating']);
    $ratingComment = $conn->real_escape_string($_POST['ratingComment']);
    
    $clientWorkoutID = htmlentities($_GET['clientWorkoutID']);
    
    //DECODES THE VALUE
  $clientWorkoutID= base64_decode($clientWorkoutID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $clientWorkoutID = ($clientWorkoutID/$_SESSION['random']);  
  
    
    $query = "SELECT * FROM TrainerPal_ClientWorkoutComplete WHERE trainerClientWorkoutID = '$clientWorkoutID'";
    $resultA = $conn->query($query);
    
    $num = $resultA -> num_rows;
    
    // ENSURES IT HAS NOT ALREADY BEEN RATED
    if ($num < 1) {
    	       				       
        $insertquery= "INSERT INTO `TrainerPal_ClientWorkoutComplete` (`trainerClientWorkoutID`, `workoutRatingID`, `comment`) 
        			   VALUES ( '$clientWorkoutID', '$rating', '$ratingComment')";
                $result = $conn->query($insertquery);
                     if(!$result){
                   echo "did not work";
                     }
                     else {
        $updateQuery = "UPDATE `TrainerPal_TrainerClientWorkouts` SET `workoutCompleted` = '2' WHERE `TrainerPal_TrainerClientWorkouts`.`clientWorkoutID` = '$clientWorkoutID'";
         $resultB = $conn->query($updateQuery);
         
                     if(!$resultB){
                   echo "did not work";
                     } else {
                         
    $get = "SELECT TrainerPal_User.email FROM TrainerPal_User INNER JOIN TrainerPal_TrainerClientWorkouts 
            ON TrainerPal_User.userID = TrainerPal_TrainerClientWorkouts.trainerID WHERE TrainerPal_TrainerClientWorkouts.clientWorkoutID = '$clientWorkoutID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have new feedback from your client in TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers); 
                     
                     header('Location: confirmedRatedWorkout.php');
                }
                }
	}
	}
	else {
	 header('Location: workoutsFromTrainer.php');
	}
?>
