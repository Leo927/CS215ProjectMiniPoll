<?php 
function load_navbar()
{
	?>
	<nav class="topnav">
		<a href=<?=ROOT_URI?>>
			<span class="nav-icon black">CSSS</span>
			<img class="logo" src="https://via.placeholder.com/50" alt="logo"/>
		</a>
		<?
		session_start();
		if (isset($_SESSION['user'])) {
			?>
				<a href="<?=ROOT_URI."pages/"?>create.php" class="nav-icon link black">CREATE</a>
				<a href="<?=ROOT_URI."pages/"?>management.php" class="nav-icon link black">MANAGE</a>
			<?
		}
		?>
		
		<a href="<?=ROOT_URI."pages/"?>result.php" class="nav-icon link black">RESULTS</a>

		<?php if(isset($_SESSION['user'])){ ?>
		<a class="avator float-right" href="<?=ROOT_URI."pages/logout.php"?>"><i class="fas fa-sign-out-alt fa-2x"></i></a>
	<?php } ?>

		<span class="user-name black float-right">
			<span>Hi</span>
			<span><?=isset($_SESSION['user']['screenName'])?$_SESSION['user']['screenName']:"visitor"?></span>
		</span>

		<?php 

		if(isset($_SESSION['user']['avatarURL']))
		{
		?>
		<img class="avator float-right" src="<?=$_SESSION['user']['avatarURL']?>" alt="avator of <?=$_SESSION['user']['screenName']?>"/>
		<?php
		}
		 ?>

		
		
	</nav>
	<?
}
 ?>
