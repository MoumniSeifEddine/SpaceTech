<?php
include('HCF/header.php');
include('HCF/container.php');
$functions=new functions();
if(isset($_POST['disc'])){
    if(isset($_POST['check'])){
        $percent=$_POST['discount'];
        $deadline=$_POST['deadline'];
        $date_deb=date("Y-m-d");
        $check=$_POST['check'];
        foreach ($check as $key) {
            $test=$functions->getProcutById($key);
            if(is_null($test[0]['discount'])){
                $disId=$functions->maxDsId()[0]['max(id)'];
                if(!($disId)){
                    $disId=1;
                }else{
                    $disId++;
                }
                $functions->addDiscount($disId,$deadline,$percent);
                $functions->addDiscountToProd($key,$disId);
                
            }else{
                $functions->updateDiscount($test[0]['discount'],$deadline,$percent);
            }
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="">
            <form method="post">
                <div class="form-group">
                    <label for="discount">discount pecentage : </label>
                    <input type="number" name="discount" style="width: 4em"min="0"max="100" required/><b>%</b>
                </div>
                <div class="form-group">
                    <label for="discount">this discont will end in  </label>
                    <input type="date" name="deadline" min="<?php echo date("Y-m-d") ?>"required/>
                </div>
                <div class="form-group">
                    <button type="submit" name="disc" class="btn btn-default">discount</button>
                </div>
                <table>
                    <thead class="thead-dark">
                        <tr class="table-success">
                            <th>ref</th>
                            <th>picture</th>
                            <th>name</th>
                            <th>price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $poductList = $functions->listProduct();
                        $i=0; 
                        foreach ($poductList as $key) {
                        ?>
                        <tr class="table-success">
                            <td><?php echo $key['id']?></td>
                            <td><img src='imageView.php?id=<?php echo $key['id'] ?>'width="100" height="100"/></td>
                            <td><?php echo $key['nom_p'] ?></td>
                            <td><?php echo $key['prix_p'] ?></td>
                            <td><input type="checkbox" name="check[]" value="<?php echo $key['id']; ?>" /></td>	</tr>
                        <?php 
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include('HCF/footer.php'); ?>