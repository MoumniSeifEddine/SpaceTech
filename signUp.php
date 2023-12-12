<?php 
	include('HCF/header.php');
	include('HCF/container.php');
	$role='client';
	$button='create';
	echo "<div class='container login rounded'><main>";
	echo '<h3 style="padding-left: 9%;">Sign Up</h3>';
	include('addAcount.php');
	echo '<p style="padding-left: 9%;">already have an account? <a href="login.php">Sign in now</a>.</p></main></div>';
	include('HCF/footer.php');
?>

<body class="bg-light">
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


			