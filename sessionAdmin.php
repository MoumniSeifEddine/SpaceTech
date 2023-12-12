<?php
$_SESSION['email'];
    if(!($_SESSION['role']=='admin')){
        header('location:index.php');
    }
?>