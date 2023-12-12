<?php
    session_start();
    include('session.php');
    include('functions.php');
    $functions=new functions();
    $id=$_GET['id'];
    $email=$_SESSION['email'];
    $list=$_GET['list'];
    $functions->remouveFromShoppingCart($id,$email,$list);
    if($list=='cart'){
        header('location:buyFromShoppingCart.php');
    }else{
        header('location:wishlist.php');
    }
?>