<?php
session_start();
if(!isset($_SESSION['loggedSession'])) {
	header("Location: login.php");
}
$activeID = $_SESSION['loggedSession'];
include('connect.php');
include('browserCheck.php');

  $invoiceID = htmlentities($_GET['invoiceID']);
   
      //DECODES THE VALUE
  $invoiceID= base64_decode($invoiceID);
  
  //DIVIDES VALUE TO ORIGINAL VALUE
  $invoiceID = ($invoiceID/$_SESSION['random']);  
  

    $Update = "UPDATE TrainerPal_Invoices SET paid = '2' WHERE invoiceID = '$invoiceID' AND owner = '$activeID'";
    
    $result = $conn->query($Update);
    if(!$result) {
    echo "did not work";
    } else {
      header("location: confirmedMarkedPaid.php");
    }
?>