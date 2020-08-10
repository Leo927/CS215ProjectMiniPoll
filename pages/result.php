<?php 
require_once  ROOT_PATH."php/reuse/debug.php";
require_once  ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/user_control.php";

function show_polls()
{
	$pollId = $_GET['pollId'];
	
	$poll = get_poll_by_id($pollId);
		
		$creator = get_user_by_id($poll['creatorId']);
		?>
		<div class="info-card row">
				<div class="grey row">
					<img class="avator" src="<?=$creator['avatarURL'] ?>" alt="avator of <?=$creator['screenName'] ?>" />
					<span class="user-name black ">
						<span>by</span>
						<span><?=$creator['screenName'] ?></span>
					</span>				
				</div>
				<h2 class="col-12 row">
					<?=$poll['title']?>
				</h2>
				<p class="row">
					<?=$poll['question']?>
				</p>
				<ul>
					<?php

					$totalVote = 0;
					foreach ($poll['answers'] as $answerId => $answer) {
						$totalVote+=$answer['voteCount'];
					}

					foreach ($poll['answers'] as $answerId => $answer) {
						?>
						
						<li>
							<div><?=$answer[answerString]?></div>
							
							<span>
								<span class="graph-bar" style="width: <?=$answer['voteCount']/$totalVote*100-1 ?>%;"></span>
								<span class=""><?=$answer['voteCount']?></span>
							</span>
						</li>
						
						<?
					}
					?>
				</ul>
				<div class="text-right grey"><span>Created On </span><span><?=$poll['createDate']?></span></div>	
			
		</div>
	</div>
	<?

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Management</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
	<?php
	include_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>

	<header class="mx-auto">
		<h1 class="text-center">Vote Result</h1>	
	</header>

	<div class="row">
		<div class="col-3"></div>
		<div class="color-sucess succcess-message"><?=$success  ?> </div>
	</div>

	<div class="row">
		<div class="col-3"></div>
		<div class="danger"><?=$error  ?> </div>
	</div>
	
	<div class="mx-auto">

		<?php
		show_polls();
		?>
		
	</div>
</body>
</html>