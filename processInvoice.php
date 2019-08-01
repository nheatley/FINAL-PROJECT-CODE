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
    $invoiceTitle = $conn->real_escape_string($_POST['invoiceTitle']);
    $invoiceAmount=  $conn->real_escape_string($_POST['invoiceAmount']);
    $invoiceDescription = $conn->real_escape_string($_POST['invoiceDescription']);
    $invoiceDate = $conn->real_escape_string($_POST['invoiceDate']);
    
 
  $userID = htmlentities($_GET['userID']);
  
      //DECODES THE VALUE
  $userID= base64_decode($userID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $userID = ($userID/$_SESSION['random']);  
  
  echo $userID;
  
  
    
    $invoiceQuery = "INSERT INTO TrainerPal_Invoices (invoiceTitle, invoiceDescription, invoiceDate, invoiceAmount, client, paid, owner)
                     VALUES ('$invoiceTitle', '$invoiceDescription', '$invoiceDate', '$invoiceAmount', '$userID', '1', '$activeID')";
                     
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
					$txt = "You have a new Invoice from your TrainerPal Trainer, thank you.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers); 
                        header('Location: confirmInvoiceSent.php');
                        }  
                        }        
   
?>