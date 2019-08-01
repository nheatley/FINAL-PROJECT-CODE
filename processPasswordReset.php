<?php  
session_start();
if(isset($_SESSION['loggedSession'])) {
header('location: account.php');
}
 include("connect.php");     
include('browserCheck.php');
	/*
     * PROCESSES POSTS OF ALL RESET FORM INPUTS AND GETS THEM READY FOR SQL CHECK
     */
    $email = $conn->real_escape_string($_POST['email']);
    
    $_SESSION['emailAddress'] = $email;
    $securityQuestion= $conn->real_escape_string($_POST['securityQuestion']);
    $securityQuestionAnswer= $conn->real_escape_string($_POST['securityQuestionAnswer']);
    
    $resetCheck= "SELECT * FROM TrainerPal_User WHERE email= '$email' AND securityQuestion = '$securityQuestion' AND securityQuestionAnswer = '$securityQuestionAnswer'";
    
    $result = $conn->query($resetCheck);
     if(!$result) {
    echo $conn -> error;
    }
    
    $num = $result -> num_rows;
    
    if ($num > 0) {
    
    header("location: finaliseReset.php");
    } else {
    
    header("location: passwordResetError.php");
    }
?>
