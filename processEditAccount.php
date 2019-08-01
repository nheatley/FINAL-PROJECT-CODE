<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: login.php");
}

$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
$read = "SELECT * FROM TrainerPal_User WHERE userID = '$activeID'";

$result = $conn->query($read);
    
if (isset($_POST['firstNameSubButton'])) {

   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);

    $Update = "UPDATE TrainerPal_User SET firstName = '$firstName' WHERE userID = '$activeID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
     header("location: editDetails.php");
}


if (isset($_POST['lastNameSubButton'])) {

   $lastName= mysqli_real_escape_string($conn, $_POST['lastName']);

    $Update = "UPDATE TrainerPal_User SET lastName = '$lastName' WHERE userID = '$activeID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
      header("location: editDetails.php");
}



if (isset($_POST['telephoneNumberSubButton'])) {

   $telephoneNumber= mysqli_real_escape_string($conn, $_POST['telephoneNumber']);

    $Update = "UPDATE TrainerPal_User  SET telephoneNumber = '$telephoneNumber' WHERE userID = '$activeID'";
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    header("location: editDetails.php");
}



if (isset($_POST['addressSubButton'])) {

   $address= mysqli_real_escape_string($conn, $_POST['address']);
   $city= mysqli_real_escape_string($conn, $_POST['city']);
   $postcode= mysqli_real_escape_string($conn, $_POST['postcode']);
   $country= mysqli_real_escape_string($conn, $_POST['country']);

    $Update = "UPDATE TrainerPal_User SET address = '$address', city = '$city', postcode = '$postcode',
               country = '$country'WHERE userID = '$activeID'";
               
    $UpdateResult = mysqli_query($conn, $Update) or die(mysqli_error($conn));
    header("location: editDetails.php");
}
?>