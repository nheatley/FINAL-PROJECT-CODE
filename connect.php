<?php
/*
 * CONNECTION TO DATABASE
 */
$host = "nheatley03.lampt.eeecs.qub.ac.uk";
$user = "nheatley03";
$password = "d2WdDFZ5XtYXpFrg";
$database = "nheatley03";

$conn = new mysqli($host, $user, $password, $database);

   if ($conn->connect_error) {
 
            $check = "not connected ".$conn->connect_error;
 
        }else{
             $check="Connected to your mysql DB.";
        }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
	<link rel="apple-touch-icon"  href="img/apple-touch-icon.png"/>
</head>
<body>

</body>

</html>