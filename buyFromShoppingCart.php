<?php
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions = new functions();
$emptyError='';
$stockError='';
if(isset($_POST['buy'])){
    $productList = $functions->prodShoppingCartList($_SESSION['email'],'cart'); 
		$amounts=$_POST['amount'];
		$location=$_POST['location'];
		$idOrder=$functions->selectMax('commands');
		$idOrder=$idOrder[0]['max(id)']+1;
		for ($i=0; $i < count($productList) ; $i++) { 
			if($amounts[$i]>$productList[$i]['stock']){
				$stockError .='<p> stock error in product : '.$productList[$i]['nom_p'].'</p></br>';
			}
		}
		if($stockError==''){
			$functions->addOrder($idOrder,$_SESSION['email'],$location);
			for ($i=0; $i <count($productList) ; $i++) { 
				$functions->orderItems($idOrder,$productList[$i]['id'],$amounts[$i]);
				$functions->updateStock($productList[$i]['id'],$amounts[$i]);
				$functions->remouveFromShoppingCart($productList[$i]['id'],$_SESSION['email'],'cart');
			}
			foreach (array_combine($amounts, $productList) as $qte => $key ){
				
			}
			
		}
	} else {
		$emptyError="You did not choose any poduct.";
	}
?>
<style>
.borderless tr td {
    border: none !important;
    padding: 2px !important;
}
</style>
<script>
	$(document).ready(function() {
        $(".amount").on("change", function() {
          updateTotal();
        });
    });
  
    function updateTotal() {
        var grandTotal = 0;
        $(".product").each(function() {
          var product = $(this);
          var price = parseFloat(product.data("price"));
          var amount = parseInt(product.find(".amount").val());
          var total = price * amount;
          product.find(".total").text(total+"DT");
          grandTotal += total;
    	});
    	$("#grand-total").text(grandTotal+"DT");
    }
</script>
<div class="container">
    <div class="form-group"></div>
	<form method="post">
		<div class="form-group">
            <?php 
			$productList = $functions->prodShoppingCartList($_SESSION['email'],'cart');
			if ($stockError) { ?>
                <div class="alert alert-warning"><?php echo $stockError; ?></div>
            <?php } 
			if (!$productList){
				echo '<div class="alert alert-warning">your card is empty</div>';
			}else{
			?>
        </div>
		<table class="table" >
			<thead class="thead-dark">
				<tr class="table-success">
					<th>ID</th>
					<th>picture</th>
					<th>name</th>
					<th>price</th>
					<th>amount</th>
					<th>total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$i=0; 
				foreach ($productList as $key) {
				?>
				<tr class="product" data-price="<?php echo $key['prix_p']; ?>">
					<td><?php echo $key['id'] ?></td>
					<td><img src='imageView.php?id=<?php echo $key['id'] ?>'width="100" height="100"/></td>
					<td><?php echo $key['nom_p'] ?></td>
					<td><div class="input-group">
						<input type="input" value="<?php echo $key['prix_p']; ?>" style="width: 3.5em"disabled/>
						<div class="input-group-append">
							<span class="input-group-text">DT</span>
						</div>
					</td>
					<td><input type="number" name="amount[<?php echo $i; ?>]" class="amount" value="1" min="1" style="width: 3em"/></td>
					<td><span class="total"><?php echo $key['prix_p']; ?>DT</span></td>
					<td><?php echo '<a href="remouveFromShoppingCart.php?id='.$key['id'].'&list=cart">'?><h4 class="bi bi-x"></h4></a></td>
				</tr>
				<?php 
					$i++;
				} ?>
				<input type="submit"name="buy" value="buy"/></br>
				<label for="location">your location</label>
				<input type="text"name="location" value="<?php echo $_SESSION['address']?>"/>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="text-right">Total Price:</td>
					<td id="grand-total">
						<?php
							$summ=$functions->totalPrice2($_SESSION['email']);
							echo $summ[0]['total'].'DT';
						?>
					</td>
				</tr>
			</tfoot>
		</table>
		<?php } ?>
	</form>
</div>
<?php include('HCF/footer.php');?>