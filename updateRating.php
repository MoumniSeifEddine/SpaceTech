<?php
include('functions.php');
$functions=new functions();
$id=$_GET['id'];
$email=$_GET['email'];
$rate=$_GET['rate'];
$exist=$functions->existRating($id,$email);
if($exist){
    $functions->updateRating($id,$email,$rate);
}else{
    $functions->addRating($id,$email,$rate);
}
header('location:ProductList.php#'.$id);
?>