<?php
include('HCF/header.php');
include('HCF/container.php');
$functions = new functions();
?>
<?php 
$productList = $functions->listProduct(); 
$i = 1;

?>
    <div class="card bg-light discount-badge-container" id="cart<?php echo $key['id'] ?>">
        <img src="imageView.php?id=<?php echo $key['id'] ?>" class="card-img-top">
        <button type="button" class="bi bi-eye-fill detailposition" data-toggle="modal" data-target="#1"><i class="fa fa-search"></i></button>
    </div>

    <div class="modal fade product_view" id="1" >
      <div class="modal-body">
        <p>helloo world </p>
</div>
    </div>


    <div class="container">
    <div class="row">
        <div class="col-md-4">
              
                
                <div class="space-ten"></div>
                <div class="btn-ground text-center">
                    <button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#1"><i class="fa fa-search"></i> Quick View</button>
                </div>
                <div class="space-ten"></div>
              </div>
            
    </div>
</div>
<div class="modal fade product_view" id="1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">HTML5 is a markup language</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p>hello</p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
   .product_view .modal-dialog{max-width: 800px; width: 100%;}
        .pre-cost{text-decoration: line-through; color: #a5a5a5;}
        .space-ten{padding: 10px 0;}
</style>
<?php include('HCF/footer.php'); ?> 