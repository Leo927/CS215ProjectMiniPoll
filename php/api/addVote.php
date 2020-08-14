<?php 
require_once ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/security.php";
require_once ROOT_PATH."php/reuse/debug.php";

if ($_SERVER["REQUEST_METHOD"]!="GET" || (!isset($_GET['answerId'])))
{
	//http_response_code(400);
	header("HTTP/1.0 400 Bad Request");
	exit();

}

add_vote($_GET['answerId']);

$pollId = get_pollId_by_answerId($_GET['answerId']);
$result = get_poll_by_id($pollId);
	echo json_encode($result);
 ?>