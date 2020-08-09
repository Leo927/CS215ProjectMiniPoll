<?php 
require_once ROOT_PATH."php/reuse/dbaccess.php";
require_once ROOT_PATH."php/reuse/form_field.php";
require_once ROOT_PATH."php/reuse/security.php";
require_once ROOT_PATH."php/reuse/debug.php";
require_once ROOT_PATH."php/reuse/user_control.php";
require_once ROOT_PATH."php/reuse/exception_handling.php";

$success ="";
$error = "";
prevent_visiter();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	main_routine();
}

function main_routine()
{
	if(check_create_poll())
{
	handle_successful_poll_creation();
}
else
{
	handle_failed_poll_creation();
}
}



function check_create_poll()
{		
	if(!check_fields())
		return false;
	$pollId = add_poll($_POST['title'], $_POST['question'], $_POST['openDate'], $_POST['closeDate']);
	if(!$pollId)
		return false;

	if(!add_answers($pollId))
		return false;

	
	return true;
}


function check_fields()
{
	$isOK = true;
	$isOK &= check_title();

	$isOK &= check_open_date();

	$isOK &= check_close_date();

	$isOK &= check_question();

	$isOK &= check_answers();
	return $isOK;
}

function sanitize_fields()
{
	$db = get_db();
	foreach ($_POST as $key => $value) {
		$value = mysql_entities_fix_string($value);
	}
	$db->close();
}

function check_title()
{

	if(!check_length($_POST["title"],1,50))
	{
		handle_error("incorrect title format");
		return false;
	}
	return true;
}

function check_open_date()
{
	if(!is_datetime($_POST["openDate"]))
	{
		handle_error("incorrect openDate format");
		return false;
	}
	return true;
}

function check_close_date()
{
	if(!is_datetime($_POST["closeDate"]))
	{
		handle_error("incorrect closeDate format");
		return false;
	}
	return true;
}

function check_question()
{
	if(!check_length($_POST["question"],1,100))
	{
		handle_error("incorrect question format");
		return false;
	}
	return true;
}

function check_answers()
{
	for ($i=1; $i <= MAX_ANSWER ; $i++) { 
		if(isset($_POST["answer$i"]))
		{
			if(!check_length($_POST["answer$i"],1,50))
			{
				handle_error("incorrect answer$i format");
				return false;
			}			
		}
	}
	return true;
}

function add_answers($pollId)
{

	for ($i=1; $i <= MAX_ANSWER ; $i++) { 
		if(isset($_POST["answer$i"]))
		{

			if(!add_answer($_POST["answer$i"],$pollId))
			{

				handle_error("interal error. failed to insert answer$i.");
				return false;
			}

		}
	}
	return true;
}

function handle_successful_poll_creation()
{
	global $success;
	global $error;
	$success = "Poll ".$_POST['title']." Successfully Created ";
	$_POST = array();
	$error ="";
}

function handle_failed_poll_creation()
{	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>CSSS Poll Create Poll</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../js/formFunctions.js"></script>
	<script type="text/javascript" src="../js/charCount.js"></script>
	<script type="text/javascript" src="../js/createPoll.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/charCount.css">
</head>
<body>
	<?php
	include_once  ROOT_PATH."php/reuse/navbar.php";
	load_navbar();
	?>

	<header class="mx-auto">
		<h1 class="text-center">Create Poll</h1>	
	</header>
	<div class="row">
		<div class="col-3"></div>
		<div class="color-sucess succcess-message"><?=$success  ?> </div>
	</div>

	<div class="row">
		<div class="col-3"></div>
		<div class="danger"><?=$error  ?> </div>
	</div>


	<form class="form" id="createPollForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">		
		<div class="form-entry">
			<div class="row">
				<div class="col-3"></div>
				<label class="form-label col-4" for="title">Title</label>
			</div>
			<div class="row">
				<div class="col-3 text-right"></div>
				<input class="form-input col-6" type="text" name="title" id="title"/>
				<p class="form-error col-3 hidden" id="title_msg">Must be 1 to 50 characters long</p>
			</div>
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-3"></div>
				<label class="form-label col-4" for="openDate">Open Date</label>
			</div>
			<div class="row">
				<div class="col-3 text-right"></div>
				<input class="form-input col-6" type="datetime-local" name="openDate" id="openDate"/>
				<p class="form-error col-3 hidden" id="openDate_msg">Must be a properDate</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-3"></div>
				<label class="form-label col-4" for="closeDate">Close Date</label>
			</div>
			<div class="row">
				<div class="col-3 text-right"></div>
				<input class="form-input col-6" type="datetime-local" name="closeDate" id="closeDate"/>
				<p class="form-error col-3 hidden" id="closeDate_msg">Must be a properDate</p>
			</div>				
		</div>

		<div class="form-entry">
			<div class="row">
				<div class="col-3"></div>
				<label class="form-label col-4" for="question">Question</label>
			</div>
			<div class="row">
				<div class="col-3 text-right"></div>
				<div class="col-6 textarea pad-0">
					<textarea class="form-input" rows="3" name="question" id="question"></textarea> 
					<p class="char-count mr-0">char:
						<span id="question_count">
							0
						</span>
						<span>
							/100
						</span>
					</p>
				</div>
				<p class="form-error col-3 hidden" id="question_msg">Must be 1 to 100 characters long</p>
			</div>				
		</div>
		
		
		<div id="answerContainer"></div>

		<div class="row">
			<div class="col-3"></div>
			<p class="col-3">
				<i class="link far fa-plus-square fa-5x" id="addAnswer"></i>
				<span class="form-error hidden" id="maxAnswerMsg">Max 5 answers</span>
			</p>
			<p class="col-3">
				<i class="far fa-minus-square fa-5x link" id="removeAnswer"></i>			
				<span class="form-error hidden" id="minAnswerMsg">Min 2 answers</span>
			</p>
		</div>

		

		<div class="row">
			<div class="col-3"></div>			
			<input type="submit" class="link form-btn col-6 black" name="singup" value="Sign Up"/>
		</div>
		<div class="row">
			<div class="col-3"></div>
			<div class="color-sucess succcess-message hidden">New vote: Vote for CSSS Prescident is created succesively. </div>
		</div>
	</form>

	
</body>
</html>