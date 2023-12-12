<?php
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$id=$_GET['id'];
$functions=new functions();
$TotalPrice=$functions->totalPrice($id);
$TotalPrice=$TotalPrice[0]['total'];
?>
<div class="container">
    <div class="form-group"></div>
        <h6>
            <a href="orderList.php">
                <input type="submit" value="<--" />
            </a>
        </h6>
	<form method="post">
		
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr class="table-success">
					<th>ref</th>
					<th>picture</th>
					<th>name</th>
					<th>price</th>
					<th>amount</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$productList=$functions->detailOrder($id);
				foreach ($productList as $key) {
				?>
				<tr class="table-success">
					<td><?php echo $key['id'] ?></td>
					<td><img src='imageView.php?id=<?php echo $key['id'] ?>'/></td>
					<td><?php echo $key['nom_p'] ?></td>
					<td><?php echo $key['prix_p'] ?></td>
					<td><?php echo $key['quantity'] ?></td>
				<?php } ?>
				total price :<input type="text"name="location" value="<?php echo $TotalPrice ?>" disabled/>
			</tbody>
		</table>
	</form>
</div>
<?php include('HCF/footer.php');?>