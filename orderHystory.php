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
	<div>
        <h6>
            <a href="OrderList.php">
                <input type="submit" value="<--" name="order history"/>
            </a>
        </h4>
    </div>
    <h3>Archiv orders :</h3>
	<table class="table">
		<thead class="thead-dark">
			<tr class="table-success">
				<th>id</th>
				<th>date</th>
				<th>location</th>
				<th>client email</th>
				<th>delivry email</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            
			$commandList = $functions->listHistory(); 
			foreach ($commandList as $key) {
			?>
			<tr class="table-success">
				<td><?php echo $key['id'] ?></td>
				<td><?php echo $key['date_com'] ?></td>
				<td><?php echo $key['location'] ?></td>
				<td><?php echo $key['clientEmail'] ?></td>
				<td><?php echo $key['delivryEmail'] ?></td>
                <td><a href="deleteOrder.php?id=<?php echo $key["id"]; ?>"><input type="submit" name="delete" value="delete"/></a></td>
                <td><a href="detailsOrder.php?id=<?php echo $key["id"]; ?>"><input type="submit" name="details" value="details"/></a></td>
			</tr>
			<?php } ?>
            
		</tbody>
	</table>
</div>
<?php include('HCF/footer.php');?>