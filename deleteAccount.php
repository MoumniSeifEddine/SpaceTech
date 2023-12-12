<?php
session_start();
include('session.php');
include('functions.php');
$functions= new functions();
$email=$_GET['email'];
$functions->deleteAccount($email);
header('location:clientList.php');
?>