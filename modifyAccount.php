<?php
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions=new functions();
$button='modify';
$email=$_GET['email'];
$client=$functions->getClientById($email);
$name=$client[0]['name'];
$lastname=$client[0]['lastname'];
$tel=$client[0]['tel'];
$address=$client[0]['address'];
$password=$client[0]['password'];
include('addAcount.php');

?>