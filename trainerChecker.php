<?php
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');

$activeID = $_SESSION['loggedSession'];

// QUERY TO SELECT FROM THE TRAINERPAL USER TABLE AND CHECK THEN CHECK THE ACCOUNT TYPE OF THE ACTIVE USER
$checkDetails= "SELECT * FROM TrainerPal_User WHERE userID= '$activeID'";

   $result = $conn->query($checkDetails);
    if(!$result) {
    echo $conn -> error;
    }
    
    while($row =$result -> fetch_assoc()) {
		
		// IF ACCOUNT TYPE IS 1 THEN ACTIVE USER IS OF BASIC USER TYPE
		// THIS MEANS THEY MUST BE REDIRECTED TO THE UPGRADE ERROR PAGE
		// WHERE THEY CAN UPGRADE THEIR ACCOUNT TO ACCESS THE TRAINER USER TYPE FEATURES
		$accountCheck = $row['accountType'];	
		if ($accountCheck == '1') {
	
		header("location: trainerLoginUpgradeError.php");
		}
		}
?>