<?php
    session_start();
    include('session.php');
    include('functions.php');
    $functions=new functions();
    $id=$_GET['id'];
    $list=$_GET['list'];
    $email=$_SESSION['email'];
    $functions->addToShoppingCart($id,$email,$list);
    header('location:productList.php#'.$list.$id);
?>