<?php
$_SESSION['email'];
    if(empty($_SESSION['email'])){
        header('location:index.php');
    }
?>