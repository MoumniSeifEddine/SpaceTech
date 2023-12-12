<?php 
$nameError='';
$lastnameError='';
$addressError='';
$emailError='';
$pwdError='';
$pwd2Error='';
$confirmation='';
$existError='';
if (isset($role)){
    $email='';
    $name='';
    $lastname='';
    $tel='';
    $address='';
    $password='';
}

if(isset($_POST['button'])){
    if($_POST['button']=="create"){
        if(empty($_POST['name'])){
            $nameError='the name field is mandatory';
        }
        if(empty($_POST['name'])){
            $lastnameError='the lastname field is mandatory';
        }
        if(empty($_POST['name'])){
            $emailError='the email field is mandatory';
        }
        if(empty($_POST['name'])){
            $addressError='the address field is mandatory';
        }
        if(empty($_POST['name'])){
            $pwdError='the password field is mandatory';
        }
        if(empty($_POST['name'])){
            $pwd2Error='the confirm password field is mandatory';
        }
        if($nameError=='' && $lastnameError=='' && $addressError=='' && $emailError=='' && $pwdError=='' && $pwd2Error==''){
            $name=$_POST['name'];
            $lastname=$_POST['lastname'];
            $ard=$_POST['adr'];
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $pwd=$_POST['pwd'];
            $pwd2=$_POST['pwd2'];
            $functions=new functions();
            $exist=$functions->getClientById($email);
            if($pwd!=$pwd2){
                $confirmation='the password is not correctly confirmed';
            }
            if($exist){
                $existError='this email is already used';
            }
            if($pwd==$pwd2 && !$exist){
                $functions->addAccount($email,$name,$role,$pwd,$lastname,$ard,$phone);
                if($role='client'){
                    header('location:login.php');
                }
                if($role='delivry'){
                    header('location:delivryList.php#'.$email);
                }
            }
            
        }
    }else if($_POST["button"]=='modify'){
        echo 'hello';
        header('location:clientList.php#'.$id);
    }
}
?>
<div class="container">	
    <div class="row g-8">
        <div class="col-md-9 col-lg-8">
            <div class="col-sm-6">
                <?php if ($existError ) { ?>
                    <div class="alert alert-warning"><?php echo $existError; ?></div>
                <?php } ?>
            </div>
                
            <div class="col-sm-6">
                <?php if ($confirmation ) { ?>
                    <div class="alert alert-warning"><?php echo $confirmation; ?></div>
                <?php } ?>
            </div>
            <form method="post" class="needs-validation">
                <div class="row g-3">

                    <div class="col-sm-6">
                        <label class="form-label" for="name">* First Name:</label>
                        <input required  type="text" placeholder="Enter your name" class="form-control" name="name" value="<?php echo $name; ?>"/>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="lastname">* Last Name:</label>
                        <input required  type="text" placeholder="Enter your lastname" class="form-control" name="lastname" value="<?php echo $lastname; ?>"/>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="adr">* Address:</label>
                        <input required  type="addresse" placeholder="Enter your address" class="form-control" name="adr" value="<?php echo $address; ?>"/>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="phone">Phone:</label>
                        <input required  type="tel" placeholder="Enter your phone nember" class="form-control" name="phone" value="<?php echo $tel; ?>"/>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="email">* Email:</label>
                        <input required  type="email" placeholder="Enter your email" class="form-control" name="email" value="<?php echo $email; ?>"/>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="pwd">* Password:</label>
                        <input required  type="password" placeholder="Enter your password" class="form-control" name="pwd" value="<?php echo $password; ?>"/>
                    </div> 
                    <div class="col-sm-12">
                        <label class="form-label" for="pwd">* Confirm Password:</label>
                        <input required  type="password" placeholder="rewrite password" class="form-control" name="pwd2" />
                    </div>
                
                    <div class="col-sm-12 py-4">
                        <button type="submit" name="button" value="<?php echo $button; ?>" class="btn btn-outline-primary"><?php echo $button; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>