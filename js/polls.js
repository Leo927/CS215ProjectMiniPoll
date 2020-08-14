function updatePolls(userId, pollContainerId, showAnswer=false, showCount=false, showLastVoteDate=false)
{

	var request = new XMLHttpRequest();

	request.onreadystatechange = function()
	{
		if(request.readyState !=4)
			return;
		if(request.status!="200"& request.status !="204")
		{
			console.log("API error");
			return;
		}


		var polls = JSON.parse(request.responseText);
		loadPolls(polls, pollContainerId, showAnswer, showCount, showLastVoteDate);
	};
	var uri = ROOT_URI+"php/api/polls.php?"+((userId)?variable("userId",userId):"");
	request.open("GET",uri,true)
	request.send(null);
	setTimeout(updatePolls, 90000,userId,pollContainerId,showAnswer,showCount,showLastVoteDate);
}

function loadPolls(polls, pollContainerId, showAnswer, showCount, showLastVoteDate)
{	
	
	var container = document.getElementById(pollContainerId);
	container.innerHTML = "";
	for (var i = 0; i <polls.length; i++) {
		container.appendChild(getPollCard(polls[i], showAnswer, showCount, showLastVoteDate));
	}
}

function getPollCard(poll, showAnswer=false, showCount=false, showLastVoteDate=false)
{

	var answerString = "";

	var totalVoteCount = getTotalVoteCount(poll);
	poll.answers.forEach((answer)=>{
		if(showAnswer==true)
		{
		answerString+=getAnswerCard(answer,totalVoteCount,showCount);
		}
	});

	var pollCard = document.createElement("div");

	pollCard.innerHTML =``;
	pollCard.innerHTML+= `<div class="info-card row">

	<div class="text-right grey">
	<span>Closing on </span>
	<span>`+poll.closeDate+`</span>
	</div>
	<h2 class="col-12 row">
	`+poll.title+`
	</h2>
	<p class="row">
	`+poll.question+`
	</p>
	<ul>	
	`+
	answerString
	+`
	</ul>
	<div class="text-right grey"><span>Last voted </span><span>`+poll.lastVoteDate+`</span></div>
	<div class="row">
	<a class="col-6 link btn" href="`+ROOT_URI+"pages/result.php?pollId="+poll.pollId+`">Result</a>
	<a class="col-6 link btn" href="`+ROOT_URI+"pages/vote.php?pollId="+poll.pollId+`">Vote</a>				
	</div>
	
	</div>	`; 
	return pollCard;
}

function getAnswerCard(answer, totalVoteCount,showVoteCount=false)
{
	console.log(totalVoteCount);
	var html ="";
	html += `<li>`;

	html+=`
	<div>`+answer.answerString+`</div>
	`;
	console.log(showVoteCount);
	if(showVoteCount==true)
	{
		html +=`
		<span>
		<span class="graph-bar" style="width: `+(answer.voteCount/totalVoteCount*100-1)+`%;"></span>
		<span class="">`+answer.voteCount+`</span>								
		</span>`
		
	}
	html+="</li>"

	return html;
}

function getTotalVoteCount(poll)
{
	var totalVoteCount = 0;
	poll.answers.forEach(function(answer){
		totalVoteCount+=parseInt(answer.voteCount,10);
	});
	return totalVoteCount;
}