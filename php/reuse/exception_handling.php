<?php 
function handle_error($error_msg)
	{
		global $error;
		$error .= "<div>".$error_msg."</div>";
	}
 ?>