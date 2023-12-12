<?php 
include('HCF/header.php');
include('HCF/container.php');
$messageError='';
$emailError='';
$email='';
if(isset($_POST['send'])){
    $email=$_POST['email'];
    $message=trim($_POST['msg']);
    if(empty($email)){
        $emailError='the email field is mandatory ';
    }
    if(empty($message)){
        $messageError='the massege filed is mandatory';
    }
    if(!(empty($email) and empty($message))){
        $functions=new functions();
		$exist=$functions->getClientById($email);
        if(!($exist)){
            header('location:signUp.php');
        }
        if($exist){
            $functions->addContact($email,$message);
            header('location:contact.php');
        }
    }
}
?>
<div class="container">
    <h3>Contact Us</h3>
    <div class="row">
        <div class="col-sm-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group"></div>
                <div class="form-group">
				<?php if ($emailError ) { ?>
					<div class="alert alert-warning"><?php echo $emailError; ?></div>
				<?php } ?>
				</div>
                <div class="form-group">
				<?php if ($messageError ) { ?>
					<div class="alert alert-warning"><?php echo $messageError; ?></div>
				<?php } ?>
				</div>
                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="text" placeholder="enter your email" name="email" value="<?php if(!(empty($_SESSION["email"]))){ echo $_SESSION["email"];}?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="message">message:</label>
                    <textarea rows="5" placeholder="your message" name="msg"  class="form-control"></textarea>
                </div>
                <input type='submit' name='send' value='send' class='btn btn-default'>
            </form>
        </div>
    </div>  
</div>
<?php include('HCF/footer.php'); ?>