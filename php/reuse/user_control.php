<?php 
	function prevent_visiter()
	{
		session_start();
		if(!isset($_SESSION['user']))
		{
			header("Location: ".ROOT_URI);
		}
	}

 ?>