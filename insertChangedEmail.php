<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: login.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
// QUERY WHICH INSERTS THE RESET PASSWORD INTO THE USER TABLE 

    $email = $conn->real_escape_string($_POST['email']);
    
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

        // QUERY WHICH INSERTS THE RESET PASSWORD INTO THE USER TABLE 
        $insertChangedEmail = "UPDATE TrainerPal_User SET email= '$email' WHERE userID ='$activeID'";
          $result = $conn->query($insertChangedEmail);
                       if(!$result){
                       echo "did not insert";
                       header('Location: enterChangedEmail.php');
                        } else {
                        
                        echo " <p> Email Changed Successfully</p>";
                        header('Location: confirmedEmailChange.php');
                       }
} else {
       echo "Cannot change to this email address";
        header('Location: enterChangedEmailError.php');
}
?>