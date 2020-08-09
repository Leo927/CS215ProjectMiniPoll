<?php 	
	require_once ROOT_PATH."php/reuse/debug.php";	
	$_SESSION = array();
	session_start();
	session_unset();
	session_destroy();
	header("Location: ".ROOT_URI);
 ?>