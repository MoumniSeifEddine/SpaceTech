<?php
include('functions.php');
$functions=new functions();
$sign=$_GET['sign'];
$id=$_GET['id'];
$orderItem=$functions->getOrderItems($id);
if($sign=="accept"){
    $functions->orderSigned($id,'true');
}
if($sign=="refuse"){
    $functions->orderSigned($id,'false');
    foreach ($orderItem as $key) {
        $product=$functions->getProcutById($key['produit_id']);
        $stock=$product[0]['stock'];
        $stock += $key['quantity'];
        $functions->addToStock($key['produit_id'],$stock);
    }
}
header('location:orderNotDelivred.php');
?>