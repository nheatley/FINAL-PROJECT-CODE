<?php
    session_start();
    unset($_SESSION['loggedSession']);
    session_destroy();
    header('location:index.php');
?>