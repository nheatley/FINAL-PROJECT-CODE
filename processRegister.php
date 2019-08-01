<?php  
session_start();
if(isset($_SESSION['loggedSession'])) {
header('location: account.php');
}
 include("connect.php");     
	include('browserCheck.php');
	/*
     * PROCESSES POSTS OF ALL INPUTS AND GETS THEM READY FOR SQL ENTRY
     */
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $passw = $conn->real_escape_string($_POST['password']);
    $securityQuestion= $conn->real_escape_string($_POST['securityQuestion']);
    $securityQuestionAnswer= $conn->real_escape_string($_POST['securityQuestionAnswer']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $postcode = $conn->real_escape_string($_POST['postcode']);
    $city = $conn->real_escape_string($_POST['city']);
    $country = $conn->real_escape_string($_POST['country']);
    $telephoneNumber = $conn->real_escape_string($_POST['telephoneNumber']);   
      
    
    /*
     * IF FILE IS INPUT THIS WILL EXECUTE OTHERWISE THE DEFAULT IMAGE WILL
     * BE ALLOCATED
     */
     
     if($_FILES['finput']['name'] != null) {
     
     $profileImage = $_FILES["finput"]["name"];
     
     $img_path =  $_FILES["finput"]["tmp_name"];
     
    move_uploaded_file($img_path, "uploadedfiles/".$profileImage);
    
    }  if ($_FILES['finput']['name'] == null) {
       $profileImage = "defaultUserImage.jpg";
    }
    
    $Read = "SELECT * FROM TrainerPal_User WHERE email = '$email' ";
    $Result = mysqli_query($conn, $Read) or die(mysqli_connect_error($conn));
   
    /*
     * CHECKS TO ENSURE A THE EMAIL IS NOT ALREADY REGISTERED USE BEFORE ALLOWING 
     * THE UPDATE 
     */
    if (mysqli_num_rows($Result) < 1) {
        /*
         * USER TABLE INSERT IS MADE
         */
        $insertquery= "INSERT INTO TrainerPal_User (firstName, lastName, password, securityQuestion, securityQuestionAnswer, email, address, city, 
                       postcode, country, telephoneNumber, profilePictureURL, accountType, upgradePaid) VALUES ('$firstName', '$lastName',
                       AES_ENCRYPT ('$passw', '3'), '$securityQuestion', '$securityQuestionAnswer', '$email', '$address', '$city', '$postcode', '$country',
                       '$telephoneNumber', '$profileImage', '1', '1')";
             
                   $result = $conn->query($insertquery);
                       if(!$result){
                       echo $conn->error;
                       
                       header('Location: index.php');
                        } else {
                        
					$to = $email;
					$subject = "My subject";
					$txt = "Thank you for registering with TrainerPal: Health & Fitness";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);
                      
                        header('Location: confirmRegisterLogin.php');
                       }
       
    } else {
          header('Location: registerError.php');
    }
?>