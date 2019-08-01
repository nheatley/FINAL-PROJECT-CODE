<?php  
session_start();
if(isset($_SESSION['loggedSession'])) {
header('location: account.php');
}
include("connect.php");     
include('browserCheck.php');
$activeID = $_SESSION['loggedSession'];
       
    /*
     * IF FILE IS INPUT THIS WILL EXECUTE AND ID IMAGE WILL BE UPLOADED
     * 
     */
     
     if($_FILES['finput']['name'] != null) {
     
     $idImage = $_FILES["finput"]["name"];
     
     $img_path =  $_FILES["finput"]["tmp_name"];
     
    move_uploaded_file($img_path, "uploadedfiles/".$idImage);
    
    }
      
    /*
     * IF FILE IS INPUT THIS WILL EXECUTE AND QUALIFICATION EVIDENCE IMAGE WILL BE UPLOADED
     * 
     */
    if($_FILES['finput2']['name'] != null) {
     
     $qualificationImage = $_FILES["finput2"]["name"];
     
     $img_path =  $_FILES["finput2"]["tmp_name"];
     
    move_uploaded_file($img_path, "uploadedfiles/".$qualificationImage);
    
    }  
 
        /*
         * VERIFICATION TABLE INSERT IS MADE
         */
        $insertquery= "INSERT INTO TrainerPal_Verifications (userID, idImage, qualificationImage, adminResponded) VALUES ('$activeID', '$idImage',
                       '$qualificationImage', '1')";
             
                   $result = $conn->query($insertquery);
                       if(!$result){
                       echo $conn->error;
                       
                       header('Location: index.php');
                        } else {
                        
              $getAdminsEmail = "SELECT TrainerPal_User.email FROM TrainerPal_User INNER JOIN TrainerPal_Admins ON TrainerPal_User.userID = TrainerPal_Admins.userID";        
                      
                       $resultB = $conn->query($getAdminsEmail);
                       if(!$resultB){
                       echo "did not work!";
                       }
                       
             while($row =$resultB -> fetch_assoc()) {
               
               $email = $row["email"];
                                       
					$to = $email;
					$subject = "New Verification Request for Admins to Approve";
					$txt = "There is a new VERIFICATION REQUEST for Admins to process in TrainerPal: Health & Fitness.";
					$headers = "From: doNotReply@TrainerPal.com" . "\r\n" .
					"CC: Nheatley85@gmail.com";

					mail($to,$subject,$txt,$headers);  
					} 
                        header('Location: confirmVerificationRequest.php');
         }
?>