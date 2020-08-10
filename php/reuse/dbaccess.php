<?php 
require_once ROOT_PATH."php/reuse/exception_handling.php";
require_once ROOT_PATH.'php/reuse/db.php';
require_once ROOT_PATH.'php/reuse/security.php';

function get_user($email, $password)
{
	require ROOT_PATH.'php/reuse/db.php';
	$db = new mysqli($hn, $un, $pw, $db);
	if($db->connect_error)
	{
		wtf("Fatal Error ".$db->connect_error);		
	}
	
	$email = mysql_entities_fix_string($db, $email);
	$query = "SELECT userId, screenName, avatarURL, birthday FROM Users 
	WHERE email = '$email' And password = '$password';";
	$result = $db->query($query);
	$db->close();	
	return $result->fetch_assoc();
}

function get_user_by_id($userId)
{
	require ROOT_PATH.'php/reuse/db.php';
	$query = "SELECT userId,screenName,email,avatarURL,birthday FROM Users WHERE userId = '$userId'";
	
	$result = query($query);
	
	return $result->fetch_assoc();
}

function get_user_vote($userId,$pollId)
{
	
	$query = "SELECT Votes.answerId FROM Votes
	LEFT JOIN Answers ON Votes.answerId = Answers.answerId
	LEFT JOIN Polls ON Answers.pollId = Polls.pollId
	WHERE Polls.pollId = $pollId AND Votes.userId = $userId;";
	$result = query($query);
	if($result==false)
		return false;
	$row = $result->fetch_assoc();
	return $row['answerId'];
}

function get_polls($userId)
{
	$userIdString = ($userId?"WHERE creatorId = $userId":"");
	
	
	$query = "SELECT Polls.pollId, title,createDate,openDate,closeDate,question,lastVoteDate, creatorId, Answers.answerId, avatarURL, screenName, answerString, IF(Votes.userId IS NULL, 0, COUNT(Answers.answerId)) AS voteCount FROM Polls
	LEFT JOIN Answers ON Polls.pollId = Answers.pollId
	LEFT JOIN Votes ON Answers.answerId = Votes.answerId
	LEFT JOIN Users ON Polls.creatorId = Users.userId
	"
	.$userIdString."
	GROUP BY Answers.answerId "
	;
	$result = query($query);	
	if($result->num_rows<=0)
		return false;
	
	return group_poll_info($result);	

	
}

function get_breif_polls($limit)
{
	$query = "SELECT pollId, title,createDate,openDate,closeDate,question,lastVoteDate, creatorId FROM Polls ORDER BY closeDate DESC LIMIT $limit";
	$result = query($query);
	return $result;
}

function group_poll_info($result)
{
	while($row = $result->fetch_assoc())
	{
		$polls[$row['pollId']]['title'] = $row['title'];
		$polls[$row['pollId']]['createDate'] = $row['createDate'];
		$polls[$row['pollId']]['closeDate'] = $row['closeDate'];
		$polls[$row['pollId']]['question'] = $row['question'];
		$polls[$row['pollId']]['answers'][$row['answerId']]["answerString"] = $row['answerString'];
		$polls[$row['pollId']]['answers'][$row['answerId']]["voteCount"]=$row['voteCount'];
		$polls[$row['pollId']]['lastVoteDate'] = $row['lastVoteDate'];
		$polls[$row['pollId']]['creatorId'] = $row['creatorId'];
		$polls[$row['pollId']]['avatarURL'] = $row['avatarURL'];
		$polls[$row['pollId']]['screenName'] = $row['screenName'];
	}
	return $polls;
}

function get_poll_by_id($pollId)
{
	$query = "SELECT Polls.pollId, title,createDate,openDate,closeDate,question,lastVoteDate, creatorId, avatarURL, screenName, Answers.answerId, answerString, IF(Votes.userId IS NULL, 0, COUNT(Answers.answerId)) AS voteCount FROM Polls
	LEFT JOIN Answers ON Polls.pollId = Answers.pollId
	LEFT JOIN Votes ON Answers.answerId = Votes.answerId
	LEFT JOIN Users ON Polls.creatorId = Users.userId
	WHERE Polls.pollId = $pollId
	GROUP BY Answers.answerId;";
	$result = query($query);
	if($result->num_rows<=0)
		return false;
	$poll = group_poll_info($result);
	return $poll[$pollId];
}



function check_screenname_exist($screenName)
{
	require ROOT_PATH.'php/reuse/db.php';
	global $error;
	$query = "SELECT * FROM Users WHERE screenName = '$screenName';";
	
	$result = query($query);
	if($result->num_rows>0)
	{
		return true;
		
		$error .="screenName already exist<br/>";
	}
	return false;
}

function check_email_exist($email)
{
	require ROOT_PATH.'php/reuse/db.php';
	global $error;
	if(query("SELECT * FROM Users WHERE email = '$email'")->num_rows > 0)
	{
		return true;

		$error .="email already exist<br/>";
	}
	return false;
}

function query($query)
{
	require ROOT_PATH.'php/reuse/db.php';
	$db = get_db();

	$result = $db->query($query);	
	$db->close();

	if($result->num_rows >0)
		return $result;
	return false;
}

function get_db()
{
	require ROOT_PATH.'php/reuse/db.php';
	$db = new mysqli($hn, $un, $pw, $db);
	if($db->connect_error)
		wtf("Fatal Error ".$db->connect_error);	
	return $db;
}

function avatorName($userId)
{

	return $userId."avator";
}

function add_user($email, $screenName, $password, $birthday)
{
	$query = "INSERT INTO Users (screenName, email, password, avatarURL, birthday)
	VALUE ('$screenName', '$email', '$password', 'placeholder', '$birthday');";
	return insert($query);
}

function update_user_avator_url($user_id, $new_url)
{
	$query = "UPDATE Users SET avatarURL='$new_url' WHERE userId = $user_id";
	
	query($query);
}

function add_poll($title, $question, $openDate, $closeDate, $creatorId)
{
	$query = "INSERT INTO Polls (title, openDate, closeDate, question, creatorId)
	VALUE ('$title','$openDate','$closeDate','$question', '$creatorId');";
	

	return insert($query);
}

function insert($query)
{
	$db = get_db();	
	if($db->query($query))
	{
		$user_id = $db->insert_id;
		$db->close();
		return $user_id;
	}
	else
		return false;
}

function add_answer($answerString, $pollId)
{
	$query = "INSERT INTO Answers(answerString, pollId)
	VALUE ('$answerString', '$pollId');";
	return insert($query);
}

function add_vote($answerId, $userId)
{
	$query1="INSERT INTO Votes (userId, answerId)
	VALUE ($userId, $answerId);";
	query($query1);
	$query2 ="
	UPDATE Polls 
	SET lastVoteDate = CURRENT_TIMESTAMP
	WHERE pollId = (SELECT pollId FROM Answers WHERE answerId = $answerId) ;";
	query($query2);
}
?>