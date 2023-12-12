<?php
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions=new functions();
if(isset($_POST['accept'])){
    $delivryEmail=$_POST['delivryEmail'];
    $id=$_GET['id'];
    $functions->acceptOrder($id,$delivryEmail);
    header('location:orderList.php');
}
?>
<div class="container">
    <h3>Assign a delivery person</h3>
    <div class="row">
        <div class="col-sm-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group"></div>
                
                <div class="form-group">
                    <label for="category">delivry person email : </label>
                    <select name="delivryEmail" class="form-control">
						<option value=""></option>
						<?php 	
							$delivry = $functions->listDelivry();
							foreach ($delivry as $key) {
						?>
							<option value="<?php echo $key['email'] ?>"><?php echo $key['name'].' : '.$key['email'];?></option>
						<?php } ?>
						</select></td>
                </div>
                <button type="submit" name="accept" class="btn btn-default">accept</button>
                            </br></br></br>
            </form>
        </div>
    </div>  
</div>
<?php include('HCF/footer.php'); ?>