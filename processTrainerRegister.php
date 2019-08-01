<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
header("location: trainerLogin.php");
}
$userID = $_SESSION['loggedSession'];
include('connect.php');     
include('browserCheck.php');
	/*
     * PROCESSES POSTS OF ALL INPUTS AND GETS THEM READY FOR SQL ENTRY
     */
     
     $gymName = $_SESSION['gymName'];
     $trainerBio = $_SESSION['trainerBio'];
     $specialistAreas =  $_SESSION['specialistAreas'];
     $gymAddress = $_SESSION['gymAddress'];
     $gymPostcode = $_SESSION['gymPostcode'];
     $gymCity = $_SESSION['gymCity'];
     $gymCountry = $_SESSION['gymCountry'];
    
   $Read = "SELECT * FROM TrainerPal_Trainer WHERE userID = '$userID' ";
   $Result = mysqli_query($conn, $Read) or die(mysqli_connect_error($conn));

    /*
     * CHECKS TO ENSURE A THE USERID  IS NOT ALREADY REGISTERED AS A TRAINER BEFORE ALLOWING 
     * THE INSERT
     */
    if (mysqli_num_rows($Result) < 1) {
    
    $insertTrainer = "INSERT INTO TrainerPal_Trainer (`userID`, `gymName`, `trainerBio`, `specialistAreas`, `gymAddress`, `gymCity`, `gymPostcode`, `gymCountry`, `verified`)
     VALUES ('$userID', '$gymName', '$trainerBio', '$specialistAreas', '$gymAddress', '$gymCity', '$gymPostcode', '$gymCountry', '1')";
             
             $result = $conn->query($insertTrainer);
                       if(!$result){
                       echo "DID NOT WORK";
                        } else {
                        
             $Update = "UPDATE TrainerPal_User SET accountType = '2' WHERE userID = '$userID'";
             $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
             
                        echo " <p> Data has been added to your database</p>";
                       header('Location: confirmTrainerRegister.php');
                       }
       
   } else {
        header('Location: index.php');
   }
?>