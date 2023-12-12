<?php
session_start();
include('session.php');
include('functions.php');
$functions= new functions();
$id=$_GET['id'];
$functions->deleteProduct($id);
header('location:productListAdmin.php');
?>