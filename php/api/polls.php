<?php 
require_once ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/security.php";
require_once ROOT_PATH."php/reuse/debug.php";

	$orderBy = isset($_GET['orderBy'])? $_GET['orderBy']:false;
	$desc = isset($_GET['desc'])? $_GET['desc']:false;
	$result = get_polls($_GET['userId'], $orderBy, $desc);
	echo json_encode($result);

 ?>