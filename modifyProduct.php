<?php 
include('HCF/header.php');
include('HCF/container.php');
include('session.php');
$functions=new functions();
$id=$_GET['id'];
$product=$functions->getProcutById($id);
$picture=$functions->getPictureByProdId($id);
$name=$product[0]['nom_p'];
$price=$product[0]['prix_p'];
$desc=$product[0]['desc_p'];
$categ=$product[0]['categ_p'];
$stock=$product[0]['stock'];
$pictureData=$picture[0]['data'];
$pictureType=$picture[0]['type'];
if(isset($_POST['modify'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $desc=$_POST['description'];
    $stock=$_POST['stock'];
    $categ=$_POST['categ'];
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $pictureData=file_get_contents($_FILES['image']['tmp_name']);
        $pictureType=$_FILES['image']['type'];
        $functions->modifyPicture($pictureType,$pictureData,$id);
    }
    $functions->modifyProduct($id,$name,$price,$desc,$categ,$stock);
}
?>
<div class="container">
    <h3>Modify Product</h3>
    <div class="row">
        <div class="col-sm-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group"></div>
                <div class="form-group">
                    <label for="name">name :</label>
                    <?php echo '<input type="text" name="name" value="'.$name.'" class="form-control" required/>'?>
                </div>
                <div class="form-group">
                    <label for="price">price :</label>
                    <?php echo '<input type="text"value="'.$price.'" name="price" class="form-control" required/>'?>
                </div>
                <div class="form-group">
                    <label for="desc">description :</label>
                    <?php echo '<textarea rows="4" cols="50" name="description" class="form-control required">'
                        .$desc.'
                    </textarea>'?>
                </div>
                <div class="form-group">
                    <label for="image">Picture : </label>
                    <img src="imageView.php?id=<?php echo $product[0]['id']; ?>" width="100" heigth="100" />
                    <input type="file" name="image" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="category">Select category</label>
                    <select name="categ" class="form-control" required>
						<?php 	
							$category = $functions->listCategory(); 
							foreach ($category as $key) {
                                if($key['id']!=$categ){
						?>
							<option value="<?php echo $key['id'] ?>"><?php echo $key['nom_categ']?></option>
						<?php } 
                                if($key['id']==$categ){
                        ?>
                            <option value="<?php echo $key['id'] ?>" selected><?php echo $key['nom_categ'] ?></option>
                        <?php } 
                        }?>
						</select></td>
                </div>
                <div class="form-group">
                    <label for="stock">stock :</label>
                    <?php echo '<input type="number" name="stock" value="'.$stock.'" class="form-control" required/>'?>
                </div>
                <button type="submit" name="modify" class="btn btn-default">Modify</button>
            </form>
        </div>
    </div>  
</div>
<?php include('HCF/footer.php'); ?>