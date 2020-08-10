<?php 
require_once  ROOT_PATH."php/reuse/debug.php";
require_once  ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/user_control.php";
require_once ROOT_PATH."php/reuse/exception_handling.php";

session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	handle_submit();
}


function load_poll()
{

	if(!($_SERVER["REQUEST_METHOD"] == "GET"))
	{
		return;
	}


	$poll = get_poll_by_id($_GET['pollId']);
	if(!$poll)
	{
		//header("Location: ". ROOT_URI);
	}


	$poll['pollId'] = $_GET['pollId'];
	?>
	<form class="mx-auto" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<div class="info-card black row">
			<input type="hidden" name="pollId" id="pollId" value="<?=$_GET[pollId]?>">
			<img class="avator" src="<?=$poll['avatarURL'] ?>" alt="avator of <?=$poll['screenName'] ?>"/>
			<span class="user-name black">
				<span>from</span>
				<span><?=$poll['screenName'] ?></span>
			</span>

			<div class="text-right grey">
				<span>Closing on </span>
				<span><?=$poll['closeDate'] ?></span>
			</div>
			<p class="row">
				<?=$poll['question'] ?>
			</p>
			<?php 
			foreach ($poll['answers'] as $answerId => $answer) {
				?>
				<label class="option-container"><?=$answer['answerString'] ?>
				<input type="radio" checked="checked" name="answerId" value="<?=$answerId ?>">
				<span class="checkmark"></span>
			</label>
			<?
		}
		?>




		<input class='form-btn link' type='submit' value='Vote' name='Vote'>
	</div>		
</form>
<?php	

}

function handle_submit()
{
	
	if(poll_closed(get_poll_by_id($_POST['pollId'])))
	{
		handle_error("The poll has expired");
		return;
	}


	add_vote($_POST['answerId'], $_SESSION['user']['userId']);

	header("Location: ".ROOT_URI."pages/result.php?pollId=".$_POST['pollId']);
}

function poll_closed($poll)
{
	if(!$poll)
		return false;

	$closeDate = new DateTime($poll['closeDate']);
	$now = new DateTime('now');
	$timeDiff = $now->diff($closeDate);
	if($timeDiff->invert)
		return true;
	return false;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vote for CSSS President</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
	<?php
	include_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>
	
	<header class="mx-auto">
		<h1 class="text-center">Vote for CSSS President</h1>	
	</header>

	<div class="row">
		<div class="col-3"></div>
		<div class="color-sucess succcess-message"><?=$success  ?> </div>
	</div>

	<div class="row">
		<div class="danger text-center"><?=$error  ?> </div>
	</div>

	<?php load_poll(); ?>
	
</body>
</html>