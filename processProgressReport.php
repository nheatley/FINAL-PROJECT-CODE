<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
header("location: trainerLogin.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');     
include('browserCheck.php');

	/*
     * PROCESSES POSTS OF ALL INPUTS AND GETS THEM READY FOR SQL ENTRY
     */
    $date = $conn->real_escape_string($_POST['date']); 
    $well = $conn->real_escape_string($_POST['well']);
    $notLike=  $conn->real_escape_string($_POST['notLike']);
    $improved = $conn->real_escape_string($_POST['improved']);
    $nextWeek = $conn->real_escape_string($_POST['nextWeek']);
    
    $userID = htmlentities($_GET['userID']);
      
      //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  
    
    $invoiceQuery = "INSERT INTO TrainerPal_ProgressReports (date, clientID, wentWell, didNotLike, couldImprove, nextWeek, trainerID)
                     VALUES ('$date', '$activeID', '$well', '$notLike', '$improved', '$nextWeek', '$userID')";
                     
             $result = $conn->query($invoiceQuery);
                       if(!$result){
                       echo "DID NOT WORK";
                        } else { 
                        
                            
    $get = "SELECT * FROM TrainerPal_User WHERE userID = '$userID'";
             $resultA = $conn->query($get);
             
               while($row =$resultA -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "My subject";
					$txt = "You have a new CLIENT PROGRESS REPORT in TrainerPal: Health & Fitness, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers); 
					
                        header('Location: confirmReportSent.php');
                        }   
                        }       
   
?>