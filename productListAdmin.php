<?php 
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions = new functions();
?>
<style>
.borderless tr td {
    border: none !important;
    padding: 2px !important;
}
</style>
<div class="container">
    <h3>product List:</h3>
    <h4><a href="addProduct.php"><input type="submit" name="add new" value="add new"/></a></h4>
	<table class="table">
		<thead class="thead-dark">
			<tr class="table-success">
				<th>reference</th>
				<th>name</th>
				<th>pice</th>
				<th>discout</th>
				<th>picture</th>
                <th>category</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            
			$productList = $functions->listProduct(); 
			foreach ($productList as $key) {
			?>
			<tr class="table-success">
				<td><?php echo $key['id'] ?></td>
				<td><?php echo $key['nom_p'] ?></td>
				<td><?php echo $key['prix_p'] ?></td>
				<td><?php
						if(! is_null($key['discount'])){
							$discount=$functions->getDiscount($key['discount']);	
							if($discount[0]['date_end']>date("Y-m-d")){
								echo $discount[0]['percentage'].'%';
							} 
						}else{
							echo '';
						}
					?>
				</td>
				<td><img src="imageView.php?id=<?php echo $key['id'] ?>" width="100" height="100"/></td>
                <td><?php echo $key['categ_p']; ?></td>
                <td><a href="deleteProduct.php?id=<?php echo $key["id"]; ?>"><input type="submit" name="delete" value="delete"/></a></td>
                <td><a href="modifyProduct.php?id=<?php echo $key["id"]; ?>"><input type="submit" name="modify" value="modify"/></a></td>
			</tr>
			<?php } ?>
            
		</tbody>
	</table>
</div>
<?php include('HCF/footer.php');?>