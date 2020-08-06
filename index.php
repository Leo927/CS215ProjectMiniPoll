<?php 
	define("ROOT_PATH", "/home/hercules/l/li725/public_html/");

	if(isset($_GET['username']) && $_GET['username']!="")
	{
		checkLogin($_GET['username'], $_GET['password']);
	}

	function checkLogin($username, $password)
	{
		require_once ROOT_PATH."php/security.php";
		$username = htmlentities(string:string, int:quote_style=2, ?string:encoding=null, bool:double_encode=true)
	}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Main Page</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<script type="text/javascript" src="js/formFunctions.js"></script>
</head>
<body>
	<nav class="topnav">
		<a href="index.html">
			<span class="nav-icon link black">CSSS</span>
			<img class="logo" src="https://via.placeholder.com/50" alt="logo"/>
		</a>
		<a href="htmls/result.html" class="nav-icon link black">ReSULTS</a>
	</nav>
	<!--
	<div class="row">
		<div class="col-4"></div>
		<ul class="top-error col-4">
		<li>Email doesn't match with record</li>
		<li>Use JS to add/remove item</li>
	</ul>
-->
	
	

	<form class="form" id="loginForm">		
		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="email">Email Address</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input col-4" type="email" name="email" id="email"/>
				<p id="email_msg" class="form-error col-4 hidden">Incorrect Email Format</p>
			</div>				
		</div>
		
		<div class="form-entry">
			<div class="row">
				<div class="col-4"></div>
				<label class="form-label col-4" for="password">Password</label>
			</div>
			<div class="row">
				<div class="col-4"></div>
				<input class="form-input  col-4" type="password" name="password" id="password"/>
				<p class="form-error col-4 hidden" id="password_msg">8 characters or longer, no spaces</p>
			</div>
		</div>
		<div class="row">
			<div class="col-4"></div>
				<a class="link" href="htmls/signUp.html">
					<p class="form-btn col-2 black">Sign Up</p>
				</a>
				
				<input type="submit" class="form-btn col-2" name="login" value="Login"/>
		</div>

	</form>

	<div class="mx-auto">
		<div class="info-card link row">
			<a class="black" href="htmls/vote.html">
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4"></div>
					<div class="col-4 text-right grey">
						<span>Closing on</span>
						<span>Aug 20, 2020</span>  
					</div>
				</div>
				<div class="row">
					<div class="col-12 t-1">
						Vote for CSSS President
					</div>
				</div>
			</a>
		</div>
		<div class="info-card link row">
			<a class="black" href="htmls/vote.html">
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4"></div>
					<div class="col-4 text-right grey">
						<span>Closing on</span>
						<span>Aug 20, 2020</span>  
					</div>
				</div>
				<div class="row">
					<div class="col-12 t-1">
						Vote for CSSS Vice President
					</div>
				</div>
			</a>
		</div>
	</div>

	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>