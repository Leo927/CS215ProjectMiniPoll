<?php 

require_once ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/form_field.php";
require_once ROOT_PATH."php/reuse/security.php";
require_once ROOT_PATH."php/reuse/debug.php";
require_once ROOT_PATH."php/reuse/user_control.php";
require_once ROOT_PATH."php/reuse/exception_handling.php";
define("TEMP_AVATOR_POSTFIX", "tempAvator___");
define("AVATOR_PATH", "uploads/userAvator/");
$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	handle_signup();
}


function handle_signup()
{
	if(check_signup_info()==false)
		return;

	sanitize_input();

	$temp_path = handle_avator();
	if(!$temp_path)
		return;

	if(check_screenname_exist($_POST['screenName'])||check_email_exist($_POST['email']))
		return;

	$user_id = add_user($_POST['email'], $_POST['screenName'], $_POST['password'], $_POST['birthday']);

	if(!$user_id)
		return;

	set_avator_url($user_id, $temp_path);


	if(handle_succesiveful_signup($user_id)==false)
		return;
}

function set_avator_url($user_id, $temp_path)
{
	$imageFileType = strtolower(pathinfo($temp_path,PATHINFO_EXTENSION));
	$new_path = ROOT_PATH.AVATOR_PATH.$user_id.".".$imageFileType;	
	if(!rename($temp_path, $new_path))
	{
		wtf("failed to rename file");
		return false;
	}
	$new_url = ROOT_URI.AVATOR_PATH.$user_id.".".$imageFileType;	
	update_user_avator_url($user_id, $new_url);
	return true;
}

function check_avator()
{
	if(isset($_FILES["avator"])==false)
	{
		$error .="no avator file is uploaded<br/>";
		return false;
	}
	return true;
}



function check_signup_info()
{
	
	$isOK = true;
	$isOK &=check_avator();
	$isOK &=check_email($_POST['email']);
	$isOK &=check_screenname($_POST['screenName']);
	$isOK &=check_password($_POST['password'], $_POST['repeatPassword']);
	$isOK &=check_birthday($_POST['birthday']);
	
	return isOK;
}

function sanitize_input()
{
	
	$db = get_db();
	$_POST['email'] = mysql_entities_fix_string($db, $_POST['email']);
	$_POST['screenName'] = mysql_entities_fix_string($db, $_POST['screenName']);
	$_POST['password'] = mysql_entities_fix_string($db, $_POST['password']);
	$_POST['birthday'] = mysql_entities_fix_string($db, $_POST['birthday']);
	
	$db->close();
	return true;
}

function handle_avator()
{
	return store_uploads(ROOT_PATH.AVATOR_PATH, "avator", $_POST['screenName'].TEMP_AVATOR_POSTFIX);	
}

function handle_succesiveful_signup($user_id)
{
	
	$user = get_user_by_id($user_id);
	session_start();
	$_SESSION['user']=$user;
	
	header("Location: ".ROOT_URI);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<script type="text/javascript" src="../js/formFunctions.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/radio-image.css">
</head>
<body>
	<?php
	include_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>
	<header class="mx-auto">
		<h1 class="text-center">Sign Up</h1>	
	</header>
	
	<form class="form" id="signUpForm" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<div class="row"></div>
			<div class="col-4"></div>
			<div class="col-4 danger"><?=$error ?></div>
		<div class="form-entry row">
			<div class="col-4"></div>
			<div class="col-4">
				<p class="form-label">Upload An Avator</p>
				<input type="file" name="avator" id="avator" value="<?=$_FILES['avator']  ?>">
				<p class="form-error col-4 hidden" id="avator_msg">Upload an avator</p>
			</div>
			<div class="col-4"></div>
			
		</div>		
		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="email">Email Address</label>
			</div>
			<div class="row">
				<div class="col-4 text-right"></div>
				<input class="form-input col-4" type="email" name="email" id="email" value="<?=$_POST['email']  ?>" />
				<p class="form-error col-4 hidden" id="email_msg">Incorrect Email Format</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="screenName">Screen Name</label>
			</div>
			<div class="row">
				<div class="col-4">no spaces or other non-word characters</div>
				<input class="form-input col-4" type="text" name="screenName" id="screenName" value="<?=$_POST['screenName']  ?>" />
				<p class="form-error col-4 hidden" id="screenName_msg">Incorrect Screen Name Format</p>
			</div>				
		</div>
		
		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="password">Password</label>
			</div>
			<div class="row">
				<div class="col-4">8 characters long, at least one non-letter character</div>
				<input class="form-input col-4" type="password" name="password" id="password" />
				<p  class="form-error col-4 hidden" id="password_msg">Incorrect Password Format</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="password">Confirm Password</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input col-4" type="password" name="repeatPassword" id="repeatPassword"/>
				<p  class="form-error col-4 hidden" id="repeatPassword_msg">Passwords Don't Match</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="birthday">Date of Birth</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input col-4" type="date" name="birthday" id="birthday" value="<?=$_POST['birthday']  ?>"  required/>
				<p  class="form-error col-4 hidden" id="birthday_msg">Please fill a proper date</p>
			</div>
		</div>

		<div class="row">
			<div class="col-4"></div>
			
			<input type="submit" class="col-4 form-btn" name="singup" value="Sign Up"/>
		</div>

	</form>
	<script type="text/javascript" src="../js/signUp.js"></script>
</body>
</html>