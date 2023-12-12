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
	<a href="addDelivry.php"><input type='submit'name='adddelivry' value='new delivry person'></a>
    <h3>Delivry person List:</h3>
	<table class="table">
		<thead class="thead-dark">
			<tr class="table-success">
				<th>name</th>
				<th>last name</th>
				<th>email</th>
				<th>passwodr</th>
				<th>tel</th>
                <th>address</th>
			</tr>
		</thead>
		<tbody>
			<?php 
            
			$delivryList = $functions->listDelivry(); 
			foreach ($delivryList as $key) {
			?>
			<tr class="table-success">
				<td><?php echo $key['name'] ?></td>
				<td><?php echo $key['lastname'] ?></td>
				<td><?php echo $key['email'] ?></td>
				<td><?php echo $key['password'] ?></td>
				<td><?php echo $key['tel']; ?></td>
                <td><?php echo $key['address']; ?></td>
                <td><a href="deleteAccount.php?email=<?php echo $key["email"]; ?>"><input type="submit" name="delete" value="delete"/></a></td>
                <td><a href="modifyAccount.php?email=<?php echo $key["email"]; ?>&button=modify"><input type="submit" name="modify" value="modify"/></a></td>
			</tr>
			<?php } ?>
            
		</tbody>
	</table>
</div>
<?php include('HCF/footer.php');?>