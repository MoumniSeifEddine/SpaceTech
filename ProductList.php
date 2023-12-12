<?php
include('HCF/header.php');
include('HCF/container.php');
$functions = new functions();
?>
<style>
    .round-black-btn {
        border-radius: 25px;
        background: #212529;
        color: #fff;
        padding: 5px 20px;
        display: inline-block;
        border: solid 2px #212529; 
        transition: all 0.5s ease-in-out 0s;
        cursor: pointer;
        font-size: 14px;
    }
    .round-black-btn:hover,
    .round-black-btn:focus {
        background: transparent;
        color: #212529;
        text-decoration: none;
    }
    .discount-badge-container {
        position: relative;
    }

    .discount-badge {
        display: inline-block;
        background-color: #F44336;
        color: #fff;
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 50px;
        text-transform: uppercase;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
        position: absolute;
        top: 10px;
        left: 10px;
        transform: rotate(-45deg);
    }
    .discount-badge:before {
        content: "";
        position: absolute;
        top: -20px;
        left: 10px;
        width: 0;
        height: 0;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-right: 15px solid #F44336;
        transform: rotate(45deg);
    }
    .rating {
        /*width: 226px;
        margin: 1  1em;*/
        font-size: 25px;
        overflow:hidden;
    }
    .rating a {
        float: right;
        color: #aaa;
        text-decoration: none;
        -webkit-transition: color .4s;
        -moz-transition: color .4s;
        -o-transition: color .4s;
        transition: color .4s;
    }
    .rating a:hover,
    .rating a:hover ~ a,
    .rating a:focus,
    .rating a:focus ~ a		{
        color: orange;
        cursor: pointer;
    }
    .position{
        position: absolute;
        left: 310px;
        top: 40px;
        font-size: 30px;
    }
    .detailposition{
        position: absolute;
        left: 310px;
        font-size: 30px;
    }
</style>
<div class="container">

    <?php 
        $productList = $functions->listProduct(); 
        $i=1;
        foreach ($productList as $key) {
            if($i==1){
                echo '<div class="card-deck py-3">';
            }
    ?>
    <div class="card bg-light discount-badge-container" id="cart<?php echo $key['id']?>">
        <img src="imageView.php?id=<?php echo $key['id'] ?>" class="card-img-top">
        <a type="button" class="bi bi-eye-fill detailposition" data-toggle="modal" data-target="#detail<?php echo $key['id']?>"><i class="fa fa-search"></i></a>
        <?php
            if (isset($_SESSION['email']) && $_SESSION['role']=='client'){
                $exist=$functions->getProdShoppingCartById($key['id'],$_SESSION['email'],'wish');
                if(!$exist){
        ?>
                    <a href="addToShoppingCart.php?id=<?php echo $key['id'] ?>&email=<?php echo $_SESSION['email'] ?>&list=wish"class="bi bi-heart position"></a>
        <?php
                }else{
        ?>
                    <span class="bi bi-heart-fill position" id="wish<?php echo $key['id']?>"></span>
        <?php }} 
            if(!is_null($key['discount'])){
                $discount=$functions->getDiscount($key['discount']);
                $date=$discount[0]['date_end'];
                $d=date("Y-m-d");
                if($d<=$date){
                    echo '<span class="badge badge-danger discount-badge">';
                    echo $discount[0]['percentage'].'% OFF</span>';
                }
            }
        ?>
        <div class="card-body" >
            <h5 class="card-title"><?php echo $key['nom_p'];?></h5>
            <div class="row">
                <?php
                    $stock=$functions->getProcutById($key['id']);
                    $stock=$stock[0]['stock'];

                    if($stock==0){
                        echo '<h5 class="col"><span class="badge badge-pill badge-danger">not available<span class="badge badge-light">'.$stock.'</span></span></h5>';
                    }else{
                        echo '<h5 class="col"><span class="badge badge-pill badge-success">available<span class="badge badge-light">'.$stock.'</span></span></h5>';
                    }
                    if(is_null($key['discount'])){
                        echo '<h5 class="col">'.$key['prix_p'].'DT</h5></div>';
                    }else{
                        $discount=$functions->getDiscount($key['discount']);
                        $date=$discount[0]['date_end'];
                        $d=date("Y-m-d");
                        if($d<=$date){
                            $newPrice=$key['prix_p']-($key['prix_p']/100*$discount[0]['percentage']);
                            echo '<h5 class="col"><del class="text-danger">'.$key['prix_p'].'</del>=>'.$newPrice.'DT</h5></div>';
                        }else{
                            echo '<h5 class="col">'.$key['prix_p'].'DT</h5></div>';
                        }
                    }
                    if(!empty($_SESSION['email'])){
                        $exist=$functions->getProdShoppingCartById($key['id'],$_SESSION['email'],'cart');                    
                        if(!($exist)){
                            echo '<h5><a href="addToShoppingCart.php?list=cart&id='.$key['id'].'& email='.$_SESSION['email'].'"class="round-black-btn">add to your Cart</a></h5>';
                        }else{
                            echo'<h5><span class="badge badge-dark">already added to your Cart</span></h5>';
                        }
                    }
                ?>
                <?php
                    echo '<div class="rating">';
                    $rating=$functions->getRating($key['id']);
                    $rating=round($rating[0]['avg(rev)'],1);
                    if (isset($_SESSION['email']) && $_SESSION['role']=='client'){
                        echo '
                        <a href="updateRating.php?rate=5&id='.$key['id'].'&email='.$_SESSION['email'].'" title="Give 5 stars">☆</a>
                        <a href="updateRating.php?rate=4&id='.$key['id'].'&email='.$_SESSION['email'].'" title="Give 4 stars">☆</a>
                        <a href="updateRating.php?rate=3&id='.$key['id'].'&email='.$_SESSION['email'].'" title="Give 3 stars">☆</a>
                        <a href="updateRating.php?rate=2&id='.$key['id'].'&email='.$_SESSION['email'].'" title="Give 2 stars">☆</a>
                        <a href="updateRating.php?rate=1&id='.$key['id'].'&email='.$_SESSION['email'].'" title="Give 1 star">☆</a>';
                    }
                    echo '<p>'.$rating.'★</p></div>';
                ?>
        </div>
        <div class="modal fade product_view" id="detail<?php echo $key['id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <center><h3><?php echo $key['nom_p'] ?></h3></center>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img src="imageView.php?id=<?php echo $key['id'] ?>">
                            </div>
                            <div class="col">
                                    <p><?php echo $key['desc_p']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col">
                                <?php
                                    if(!empty($_SESSION['email'])){
                                        $exist=$functions->getProdShoppingCartById($key['id'],$_SESSION['email'],'cart');                    
                                        if(!($exist)){
                                            echo '<h5><a href="addToShoppingCart.php?list=cart&id='.$key['id'].'& email='.$_SESSION['email'].'"class="round-black-btn">add to your Cart</a></h5>';
                                        }else{
                                            echo'<h5><span class="badge badge-dark">already added to your Cart</span></h5>';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="col">
                                 <?php
                                    if(is_null($key['discount'])){
                                        echo '<h5 class="col">'.$key['prix_p'].'DT</h5>';
                                    }else{
                                        $discount=$functions->getDiscount($key['discount']);
                                        $date=$discount[0]['date_end'];
                                        $d=date("Y-m-d");
                                        if($d<$date){
                                            $newPrice=$key['prix_p']-($key['prix_p']/100*$discount[0]['percentage']);
                                            echo '<h5 class="col"><del class="text-danger">'.$key['prix_p'].'</del>=>'.$newPrice.'DT</h5>';
                                        }else{
                                            echo '<h5 class="col">'.$key['prix_p'].'DT</h5>';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            $i++;
            if($i==4){
                echo '</div>';
                $i=1;
            }
        }
    ?>
    
    <?php
        if($i==3){
            echo '<div class="col"></div>';
        }
        if($i==2){
            echo'<div class="col"></div><div class="col"></div>';
        }
    
    ?>
</div>
<?php include('HCF/footer.php');?>