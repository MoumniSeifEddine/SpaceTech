<?php
    include('HCF/header.php');
    include('HCF/container.php');
    include('session.php');
    $functions=new functions();
	$productList = $functions->prodShoppingCartList($_SESSION['email'],'wish'); 
	echo '<div class="container">';
    foreach ($productList as $key) {
	    echo'<img src="imageView.php?id='.$key['id'].'" />';
        echo '<p>'.$key['nom_p'].'</p>';
        echo '<p>prix : '.$key['prix_p'] .'</p>';
		echo '<a href="detailProduct.php?id='.$key['id'].'">
				<input type="submit" name="detail" value="detail">
			</a>';
        echo '<a href="remouveFromShoppingCart.php?id='.$key['id'].'&list=wish">
            <input type="submit" name="remouve" value="remouve">
            </a></br>';  
    }
    if($productList){
        echo '<a href="buyFromShoppingCart.php?">
            <input type="submit" name="buy them" value="buy them">
            </a>';
    }
    echo '</div>';
include('HCF/footer.php');
?>