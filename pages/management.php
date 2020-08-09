<?php 
require_once  ROOT_PATH."php/reuse/debug.php";
require_once  ROOT_PATH."php/reuse/dbaccess.php";
require ROOT_PATH."php/reuse/user_control.php";

prevent_visiter();




function show_polls()
{
	$polls = get_polls();

	foreach ($polls as $pollId => $poll) {
		//$userVote = get_user_vote($_SESSION['user']['userId'], $pollId);
		?>
		<div class="info-card link row">
			<a class="black" href="vote.php?pollId=<?=$pollId?>">
				<div class="text-right grey">
					<span>Closing on </span>
					<span><?=$poll['closeDate']?></span>  
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
				<div class="text-right grey"><span>Last voted </span><span><?=$poll['lastVoteDate']?></span></div>
			</a>
			
			
		</div>
	</div>
	<?
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Management</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
	<?php
	require_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>

	<header class="mx-auto">
		<h1 class="text-center">Poll Management</h1>	
	</header>


	<div class="mx-auto">
		<?php
		 show_polls();
		?>		
	</div>
</body>
</html>