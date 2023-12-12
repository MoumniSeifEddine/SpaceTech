<?php 
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions=new functions();
$data=$functions->selectMax('picture');
if($data){
    $pictureId=$data[0]['max(id)']+1;
}else{
    $pictureId=1;
}
if (isset($_POST['add'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $desc=$_POST['desc'];
    $stock=$_POST['stock'];
    $categ=$_POST['category'];
    $pictureType=$_FILES['image']['type'];
    $pictureData=file_get_contents($_FILES['image']['tmp_name']);
    $functions->addProduct($id,$name,$price,$desc,$categ,$stock);
    $functions->addPicture($pictureId,$pictureType,$pictureData,$id);
    header('location:addProduct.php');
}
?>
<div class="container">
    <h3>New Product</h3>
    <div class="row">
        <div class="col-sm-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group"></div>
                <div class="form-group">
                    <label for="id">reference :</label>
                     <input type='text' placeholder="Product reference" name='id' class='form-control'require/> 
                </div>
                <div class="form-group">
                    <label for="name">name :</label>
                    <input type="text" placeholder="Product name" name="name" class="form-control"require/>
                </div>
                <div class="form-group">
                    <label for="price">price :</label>
                    <input type="text" placeholder="Product Price" name="price" class="form-control"require/>
                </div>
                <div class="form-group">
                    <label for="desc">description :</label>
                    <textarea rows="4" cols="50" placeholder="Product description" name="desc" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Picture : </label>
                    <input type="file"  name="image" class="form-control"require/>
                </div>
                <div class="form-group">
                    <label for="category">category  : </label>
                    <select name="category" class="form-control"require>
						<option value=""></option>
						<?php 	
							$categ = $functions->listCategory(); 
							foreach ($categ as $key) {
						?>
							<option value="<?php echo $key['id'] ?>"><?php echo $key['nom_categ'] ?></option>
						<?php } ?>
						</select></td>
                </div>
                <div class="form-group">
                    <label for="stock">stock :</label>
                    <input type="text" placeholder="Product stock" name="sock" class="form-control"require/>
                </div>
                <button type="submit" name="add" class="btn btn-default">Add</button>
                            </br></br></br>
            </form>
        </div>
    </div>  
</div>
<?php include('HCF/footer.php'); ?>