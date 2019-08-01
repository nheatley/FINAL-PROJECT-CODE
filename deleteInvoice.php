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

    $delete = "DELETE FROM TrainerPal_Invoices WHERE invoiceID = '$invoiceID'";
    
    $result = $conn->query($delete);
    if(!$result) {
    echo "did not work";
    } else {
      header("location: confirmedDeleteInvoice.php");
    }
?>