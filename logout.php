<?php
session_start();
session_unset();
session_destroy();

// Redirect specifically to your customer login page
header("Location: login.php"); 
exit();
?>