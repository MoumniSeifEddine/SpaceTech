<?php
include('HCF/header.php');
include('HCF/container.php');
$userError='';
$buttom='create';
if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=$_POST['pwd'];
	$functions=new functions();
	$user=$functions->getClientById($email);
	if($user){
		$_SESSION['email']=$user[0]['email'];
		$_SESSION['role']=$user[0]['role'];
		$_SESSION['phone']=$user[0]['tel'];
		$_SESSION['name']=$user[0]['name'];
		$_SESSION['lastname']=$user[0]['lastname'];
		$_SESSION['address']=$user[0]['address'];
		$_SESSION['password']=$user[0]['password'];
		header('location:index.php');
	}
	if(! ($user)){
		$userError='password or email does not exist';
	}
}
?>
<style>
    .vertical-line{
        border-left: 2px solid #000;
        display: inline-block;
        height: 580px;
        margin: 0 px;
    }
	.login {
		padding: 20px;
		box-shadow: inset 0em 0em 10em 0em rgba(150, 150, 150, 3), 0.4em 0.2em 0 0px rgb(100, 100, 100),
			1em 1em 1em rgba(0, 0, 0, 0.3);
	}
</style>

<div class="container login rounded " >
	<div class="row" style="background-color=#aaa">
		<div class="col-md-5">
			<img src="image/SpaceTech.png" width="100"/>
			<h2>Login:</h2>
			<div class="row">
				<div class="col-sm-11">
					<form method="post">
					<div class="form-group">
						<?php if ($userError ) { ?>
							<div class="alert alert-warning"><?php echo $userError; ?></div>
						<?php } ?>
					</div>
					<div class="">
					</div>
					<div class="form-floating mb-3">
						<label for="email">email:</label>
						<input type="email" class="form-control" name="email" id="email" placeholder=" Email address" required >
					</div>
					<div class="form-floating mb-3">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pwd" id="pwd" placeholder=" passwod" required>
					</div>  
					<a href='index.php'><button type="submit" name="login" class="btn btn-outline-dark">Login</button></a>
					<p>Don't have an account? <a href="signUp.php?button=<?php echo $buttom ?>">Sign up now</a>.</p>
					</form><br>
				</div>
			</div>
		</div>
		<span class="vertical-line"></span>
		<div class="col-md-4"><img src="image/login.png" width="180%" height="90%"/></div>	
	</div>
</div>
<?php include('HCF/footer.php');?>


