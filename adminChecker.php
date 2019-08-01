<?php
if(!isset($_SESSION['loggedSession'])) {
 header("location: trainerLogin.php");
} 
include('connect.php');

$activeID = $_SESSION['loggedSession'];

// QUERY TO SEE IF THE USER OF ACTIVE ID IS REGISTERED AS AN ADMIN
$checkDetails= "SELECT * FROM TrainerPal_Admins WHERE userID = '$activeID'";

   $result = $conn->query($checkDetails);
    if(!$result) {
    echo $conn -> error;
    }
    
    $num = $result -> num_rows;

// IF NUM IS EQUAL TO ZERO THAT MEANS NO INSTANCES EXIST WHERE THE USER IS IN THE ADMIN TABLE AS AN ADMIN
// THEY MUST BE REDIRECTED TO AN ERROR PAGE
if ($num == 0) {  
		header("location: adminPageErrorAttempt.php");
		}		
?>