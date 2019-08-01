<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
 header("location: account.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');
$passw = $conn->real_escape_string($_POST['password']);
$email = $conn->real_escape_string($_POST['email']);

//TAKES THE ENCRYPTED PASSWORD OUT OF THE DATABASE AND DECRYPTS IT IN ORDER TO COMPARE WITH THE ENTERED LOGIN DATA
 
$checkDetails= "SELECT * FROM TrainerPal_User WHERE userID= '$activeID' AND AES_DECRYPT(password, '3') = '$passw' AND email = '$email'";

$result = $conn->query($checkDetails);
    if(!$result) {
    echo $conn -> error;
    }

$num = $result -> num_rows;
if ($num > 0) {

    header("location: enterChangedEmail.php");
	} else {
	 header("location: changeEmailError.php");
}
?>