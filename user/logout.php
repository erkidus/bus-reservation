<?php
// Destroy session and redirect to login page
session_start();
session_destroy();
header("Location: login.php");
exit;
?>
