<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: trainerLogin.php");
}

$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

    $gymAddress = $_SESSION['gymAddress'];
    $gymPostcode = $_SESSION['gymPostcode'];
    $gymCity = $_SESSION['gymCity'];
    $gymCountry = $_SESSION['gymCountry'];

    $Update = "UPDATE TrainerPal_Trainer  SET gymAddress = '$gymAddress', gymCity = '$gymCity', gymPostcode = '$gymPostcode',
               gymCountry = '$gymCountry'WHERE userID = '$activeID'";
               
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    if(!$UpdateResult) {
    header("location: index.php");
    } else {
    header("location: editTrainerDetails.php");
    }
?>