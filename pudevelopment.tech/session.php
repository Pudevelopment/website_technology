<?php
session_start();

if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true) {
    $baseUrl = dirname($_SERVER['SCRIPT_NAME']); 
    header("Location: ../Mainsite.php");
    exit;
}
?>
