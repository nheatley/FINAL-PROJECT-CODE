<?php 
session_start();
include("connect.php");
include('browserCheck.php');

$email = $conn->real_escape_string($_POST['email']);
$passw = $conn->real_escape_string($_POST['password']);

//TAKES THE ENCRYPTED PASSWORD OUT OF THE DATABASE AND DECRYPTS IT IN ORDER TO COMPARE WITH THE ENTERED LOGIN DATA
 
$checkDetails= "SELECT * FROM TrainerPal_User WHERE email= '$email' AND AES_DECRYPT(password, '3') = '$passw'";

		//SETS A RANDOM NUMBER TO BE USED IN THE ENCRYPTION OF VARIABLES
		// SO THAT THE VARIABLE EXPOSED IN THE URL IS PROTECTED
		$_SESSION['random'] = (mt_rand(10,100));

$result = $conn->query($checkDetails);
    if(!$result) {
    echo $conn -> error;
    }

$num = $result -> num_rows;

if ($num == 0) {
    	header("location: trainerLoginError.php");
      }

if ($num > 0) {

		while($row =$result -> fetch_assoc()) {
		
		$accountCheck = $row['accountType'];
		$_SESSION['loggedSession'] = $row['userID'];
		$_SESSION['accountType'] = $accountCheck;
		
		if ($accountCheck == '1') {
		
		$_SESSION['loggedSession'] = $row['userID'];

		}
    else {
    	while($row =$result -> fetch_assoc()) {
		$_SESSION['loggedSession'] = $row['userID'];
		$_SESSION['accountType'] = $accountCheck;

		 }
		  header("location: trainerAccount.php");
	}
	}	}
?>		
			
			
		