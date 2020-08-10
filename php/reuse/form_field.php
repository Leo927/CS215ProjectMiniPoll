<?php 
require_once ROOT_PATH."php/reuse/debug.php";
require_once ROOT_PATH."php/reuse/exception_handling.php";
function check_screenname($screen_name)
{
	if(preg_match ( '/\s/' ,$screen_name )==false &&
		preg_match('/\W/',$screen_name)==false)
		return true;
	else
	{		
		handle_error("screen name format incorrect<br/>");
		return false;
	}
}

function check_email($email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return false;		
		handle_error("email format incorrect<br/>");
	}
	return true;
}

function check_password($password, $repeatPassword)
{
	if(!(preg_match('/^.{8}$/', $password) &&
		preg_match('/[^a-zA-Z0-9_]+/', $password)))
	{
		handle_error("password format incorrect<br/>");		
		return false;
	}			
	if($password!=$repeatPassword)
	{
		handle_error("passwords don't match<br/>");		
		return false;
	}
	return true;
}

function check_birthday($date, $format = 'Y-m-d')
{
	
	return is_date($date,$format);
}

function is_date($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	if($d && $d->format($format) === $date)
		return true;
	else
	{
		handle_error("date format incorrect");

		return false;
	}
}

function is_datetime($date, $format = 'Y-m-d H:i:s')
{
	$date = (date("Y-m-d H:i:s",strtotime($date)));
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function check_length($string, $min, $max)
{
	return preg_match ( '/^.{'.$min.','.$max.'}$/' ,$string );
}

function store_uploads($target_dir, $id, $name)
{

	$target_file = $target_dir . basename($_FILES[$id]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$target_file = $target_dir . $name.".".$imageFileType;
// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES[$id]["tmp_name"]);
		if($check !== false) {
			handle_error("File is an image - " . $check["mime"] . ".");
			$uploadOk = 1;
		} else {
			handle_error( "File is not an image.");
			$uploadOk = 0;
			return false;
		}
	}

// Check if file already exists
	/*
	if (file_exists($target_file)) {
		handle_error("Sorry, file already exists.");
		$uploadOk = 0;
		return false;
	}*/

// Check file size
	if ($_FILES[$id]["size"] > 500000) {
		handle_error("Sorry, your file is too large.");
		$uploadOk = 0;
	}

// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		handle_error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	handle_error("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES[$id]["tmp_name"], $target_file)) {
		return $target_file;
	} else {
		handle_error("Sorry, there was an error uploading your file.");
		return false;
	}
}
}
?>