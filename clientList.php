<?php
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
include('sessionAdmin.php');
$functions = new functions();
?>
<style>
.borderless tr td {
    border: none !important;
    padding: 2px !important;
}
</style>
<div class="container">
    <h3>client List:</h3>
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
            
			$clientList = $functions->listClient(); 
			foreach ($clientList as $key) {
			?>
			<tr id="<?php echo $key['email']?>">
				<td><?php echo $key['name'] ?></td>
				<td><?php echo $key['lastname'] ?></td>
				<td><?php echo $key['email'] ?></td>
				<td><?php echo $key['password'] ?></td>
				<td><?php echo $key['tel']; ?></td>
                <td><?php echo $key['address']; ?></td>
                <td><a href="deleteAccount.php?email=<?php echo $key["email"]; ?>"><input type="submit" name="delete" value="delete"/></a></td>
                <td><a href="modifyAccount.php?email=<?php echo $key["email"]; ?>"><input type="submit" name="modify" value="modify"/></a></td>
			</tr>
			<?php } ?>
            
		</tbody>
	</table>
</div>
<?php include('HCF/footer.php');?>