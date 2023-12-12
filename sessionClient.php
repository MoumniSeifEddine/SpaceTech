<?php
$_SESSION['email'];
    if(!($_SESSION['role']=='client')){
        header('location:index.php');
    }
?>