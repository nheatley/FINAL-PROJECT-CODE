<?php
include("connect.php");
/*
 * IF THE CHECKEMAIL() FUNCTION IS CALLED THIS WILL EXECUTE
 */
if (!empty($_POST["email"])) {
    $emailCheck = $_POST['email'];
    $Read = "SELECT count(*) FROM TrainerPal_User WHERE email = '$emailCheck'";
    
    $Result = mysqli_query($conn, $Read) or die(mysqli_error($conn));

    if (mysqli_num_rows($Result) > 0) {
        $row = mysqli_fetch_assoc($Result);
        $count = $row['count(*)'];
        if ($count > 0) {
            echo "<span class='notAvailable'> <font color = 'red'>This email is already registered to an account. 
                  Please Login or use another.</font></span>";
        } else {
            echo "<span class='available'> <font color = 'green'> You're good, this Email is available.</font></span>";
        }
    }
}
?>