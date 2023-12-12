<?php 
session_start();
include('functions.php');
if(!isset($_SESSION['email'])){
    $_SESSION['email']='';
    $_SESSION['role']='';
    $_SESSION['phone']='';
    $_SESSION['name']='';
    $_SESSION['lastname']='';
    $_SESSION['address']='';
    $_SESSION['password']='';
}
?>
<style>
    .icon {
        display: flex;
        position: relative;
        bottom: 10px;
        left: 24px;
    }
    .circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #0e0;
        
    }
</style>
<body style="background-color:#cccc">
    <div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        
            <div class="col-3 ">
                <a class="navbar-brand" href='index.php'><img src="image/SpaceTech.png" width="40">SpaceTech</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-5 px-5 ">
                <form class="collapse navbar-collapse" id="navbarSupportedContent" method="post">
                    <input class="form-control mr-4 h-25" type="search" placeholder="Search" aria-label="Search">
                    <button class="badge btn btn-outline-secondary" type="submit">Search</button> 
                </form>
            </div>
            <div class="col-2 ">
                <?php if(isset($_SESSION['email']) && $_SESSION['role']=='client') {?>
                    <div class="row">
                        <div class="col-0">
                            <a href="buyFromShoppingCart.php" alt="cart" data-toggle="tooltip" data-placement="top" title="Cart">
                                <span class="bi bi-cart4" style="font-size:30px;"></span><span class="badge badge-pill badge-danger">
                                <?php 
                                    $functions=new functions();
                                    $number=$functions->countShoppingCart($_SESSION['email'],'cart');
                                    if ($number[0]['count(*)']>0){
                                        echo $number[0]['count(*)'];
                                    }else{
                                        echo '0';
                                    }
                                ?>
                            </span></a>
                        </div>
                        <div class="col">
                            <a href="wishlist.php" alt="wishlist" data-toggle="tooltip" data-placement="top" title="Wishlist">
                                <span class="bi bi-suit-heart-fill" style="font-size:30px;"></span><span class="badge badge-pill badge-danger">
                                <?php 
                                    $functions=new functions();
                                    $number=$functions->countShoppingCart($_SESSION['email'],'wish');
                                    if ($number[0]['count(*)']>0){
                                        echo $number[0]['count(*)'];
                                    }else{
                                        echo '0';
                                    }
                                ?>
                            </span></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-2 ">
                <form class="form-inline">
                    <?php if(! isset($_SESSION['email']) || $_SESSION['email']=='') {?> 
                        <a href='login.php' class="badge btn btn-outline-primary" role="button">Sign in</a>
                    <?php } else if(isset($_SESSION['email'])&& $_SESSION!=''){ ?>
                        <a href='logout.php' class="badge btn btn-outline-danger" role="button">Sign out</a>
                        
                    <?php } ?>
                </form>
            </div>
        
    </nav>


    <nav class="navbar navbar-expand navbar-dark bg-dark " >
        <div class="col-1"></div>
        <div class="col-7">
                
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if(isset($_SESSION['email']) && $_SESSION['role']=='admin'){?>
                        <h6 class="nav-item"><a href='productListAdmin.php' class="nav-link">product List</a></h6>
                        <h6 class="nav-item"><a href='discount.php' class="nav-link">discount management</a></h6>
                        <h6 class="nav-item"><a href='clientList.php' class="nav-link">client List</a></h6>
                        <h6 class="nav-item"><a href='delivryList.php' class="nav-link">delivry List</a></h6>
                        <h6 class="nav-item"><a href='orderList.php' class="nav-link">Order list 
                            <?php 
                                $functions=new functions();
                                $number=$functions->countNewOrder();
                                if ($number[0]['count(*)']>0){
                                    echo $number[0]['count(*)'];
                                }
                             ?>
                        </a></h6>
                    <?php } ?>
                    <?php if(isset($_SESSION['email']) && $_SESSION['role']=='delivry'){?>
                        <h5 class="nav-item"><a href='delivry.php' class="nav-link">new orders</a></h5>
                    <?php } ?>
                    <?php if(isset($_SESSION['email']) && $_SESSION['role']=='client') {?>
                        <h5 class="nav-item"><a href='ProductList.php' class="nav-link">Shop</a></h5>
                        <h5 class="nav-item"><a href='contact.php' class="nav-link">contact us</a></h5>
                        <h5 class="nav-item"><a href='about.php' class="nav-link">about us</a></h5>
                    </ul>
                </div>
            </div>
                <div class="col-sm-2 ">
                    
                    
                    
                    </div>
                    <div class="col-sm-10 ">
                    <div class="row">
                        <div class="col-sm-0">
                            <h3><a href='modifyAccount.php?email=<?php echo $_SESSION['email'] ?>'class="bi bi-person-circle"><div class="icon"><span class="circle"></span></div></a></h3>
                        </div>
                        <div class="col">
                            <h5 class="text-white-50"><?php echo $_SESSION['name'].' '.$_SESSION['lastname']; ?></h5>
                        </div>
                    </div>
                </div>
                    <?php } ?>
                    <?php if(empty($_SESSION['email']) || ! isset($_SESSION['email'])){?>
                        <h5 class="nav-item"><a href='ProductList.php' class="nav-link">Shop</a></h5>
                        <h5 class="nav-item"><a href='contact.php' class="nav-link">contact us</a></h5>
                        <h5 class="nav-item"><a href='about.php' class="nav-link">about us</a></h5>
                    <?php } 
                    ?>
                </ul>
                
            </div>
        </div>
        
    </nav>
    </div>
    <div class="col py-5"></div>
    <div class="col py-5"></div>
