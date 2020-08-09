<?php
require_once ROOT_PATH."php/reuse/debug.php";
$email;
$error;
if(isset($_POST["submitted"]) && $_POST['submitted']==1)
{	
	check_login();	
}

session_start();
if(isset($_SESSION['user']))
{
	header("Location: ".ROOT_URI."pages/management.php");
}












function check_login()
{
	require_once ROOT_PATH."php/reuse/dbaccess.php";
	global $email;
	global $error;
	if(strlen( $_POST["email"])<=0 || strlen($_POST["password"])<8 )
	{
		$error = "please check your inputs";
		$email = $_POST['email'];
		return;
	}

	$user = get_user($_POST["email"], $_POST["password"]);
	if($user)
	{
		session_start();
		$_SESSION["user"]=$user;
		
		header("Location: ".ROOT_URI."pages/management.php");

		exit();
	}
	else
	{		
		$error = "no matching email and password";
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Main Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<script type="text/javascript" src="js/formFunctions.js"></script>
</head>
<body>
	<?php
	include_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>


	<form class="form" id="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">		
		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="email">Email Address</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input col-4" type="email" name="email" id="email" value="<?=$_POST["email"]?>" />
				<p id="email_msg" class="form-error col-4 hidden">Incorrect Email Format</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="password">Password</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input  col-4" type="password" name="password" id="password"/>
				<p class="form-error col-4 hidden" id="password_msg">8 characters or longer, no spaces</p>
			</div>
		</div>
		<div class="row">
			<div class="col-4"></div>
			<a class="link" href="<?=ROOT_URI?>pages/signUp.php">
				<p class="form-btn col-2 black">Sign Up</p>
			</a>
			<input type="hidden" name="submitted" value="1">
			<input type="submit" class="form-btn col-2" name="login" value="Login"/>
		</div>
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 danger"><?=$error?></div>
		</div>
	</form>

	<div class="mx-auto">
		<div class="info-card link row">
			<a class="black" href="pages/vote.php">
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4"></div>
					<div class="col-4 text-right grey">
						<span>Closing on</span>
						<span>Aug 20, 2020</span>  
					</div>
				</div>
				<div class="row">
					<div class="col-12 t-1">
						Vote for CSSS President
					</div>
				</div>
			</a>
		</div>
		<div class="info-card link row">
			<a class="black" href="pages/vote.php">
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4"></div>
					<div class="col-4 text-right grey">
						<span>Closing on</span>
						<span>Aug 20, 2020</span>  
					</div>
				</div>
				<div class="row">
					<div class="col-12 t-1">
						Vote for CSSS Vice President
					</div>
				</div>
			</a>
		</div>
	</div>

	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>

