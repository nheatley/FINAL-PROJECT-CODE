<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: trainerLogin.php");
}

$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

$read = "SELECT * FROM TrainerPal_Trainer WHERE userID = '$activeID'";

$result = $conn->query($read);
    
if (isset($_POST['trainerBioSubButton'])) {

   $trainerBio = mysqli_real_escape_string($conn, $_POST['trainerBio']);

    $Update = "UPDATE TrainerPal_Trainer SET trainerBio = '$trainerBio' WHERE userID = '$activeID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
     header("location: editTrainerDetails.php");
}


if (isset($_POST['specialistAreasSubButton'])) {

   $specialistAreas = mysqli_real_escape_string($conn, $_POST['specialistAreas']);

    $Update = "UPDATE TrainerPal_Trainer SET specialistAreas = '$specialistAreas' WHERE userID = '$activeID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
      header("location: editTrainerDetails.php");
}


if (isset($_POST['gymAddressSubButton'])) {


    $gymAddress = $_SESSION['gymAddress'];
    $gymPostcode = $_SESSION['gymPostcode'];
    $gymCity = $_SESSION['gymCity'];
    $gymCountry = $_SESSION['gymCountry'];

    $Update = "UPDATE TrainerPal_Trainer  SET gymAddress = '$gymAddress', gymCity = '$gymCity', gymPostcode = '$gymPostcode',
               gymCountry = '$gymCountry'WHERE userID = '$activeID'";
               
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    header("location: editTrainerDetails.php");
}

?>