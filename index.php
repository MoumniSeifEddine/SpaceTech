<?php 
include('HCF/header.php');
include('HCF/container.php');
$functions=new functions();
if($_SESSION["role"]!='admin' && $_SESSION['role']!='delivry'){
?>
<div class="container">
    <div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide bg-secondary" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner w-100">
      <div class="carousel-item active ">
        <img src="image/etape1.png" class="d-block " alt="..." style="position:relative;left: 190px; margin-bottom: 120px;">
        <div class="carousel-caption d-none d-md-block bg-secondary">
          <h5>Ordering</h5>
          <p>Order what you want from evry where.</p>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="image/etape2.png" class="d-block " alt="..." style="position:relative;left: 190px; margin-bottom: 120px;">
        <div class="carousel-caption d-none d-md-block bg-secondary">
          <h5>Deliver Order</h5>
          <p>your order will be delivred in 48 hours.</p>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="image/etape3.png" class="d-block " alt="..." style="position:relative;left: 190px; margin-bottom: 120px;">
        <div class="carousel-caption d-none d-md-block bg-secondary">
          <h5>Payment</h5>
          <p>pay when your order is between your hand .</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
<?php } else if($_SESSION['role']=='admin'){?>
<div class="container">
  <h1>Welcom Admin to your session <h1>
</div>
<?php } else{?>
<div class="container">
  <h1>Welcom delevry to your session <h1>
</div>
<?php }?>