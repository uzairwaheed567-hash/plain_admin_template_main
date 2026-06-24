<?php
session_start();

if(
    !isset($_SESSION['SchoolLoggedIn'])
){
    header("Location: index.php");
    exit;
}
?>