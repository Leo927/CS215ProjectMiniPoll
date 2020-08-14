//when vote form is submitted
//	extract the answerId from form
//	hide Vote button
//	Show a processing message
//	
//when response come back. 
//	remove processing message
//	add vote result
document.addEventListener("DOMContentLoaded", function(event){
	document.getElementById("voteForm").addEventListener('submit', handleVote);

});	


function handleVote(event)
{
	console.log('handle vote');
	event.preventDefault();
	hideVoteButton();


	var request = new XMLHttpRequest();

	request.onreadystatechange = function()
	{
		if(request.readyState !=4)
			return;
		switch (request.status) {
			case 200:				
			case 204:

				break;
			default:
				console.log("API error");
				return;
				
		}
		if(request.status!="200" & request.status !="204")
		{
			console.log("API error");
			return;
		}		
		
		var poll = JSON.parse(request.responseText);
		console.log(poll);
		AddResult(poll);
	};
	var uri = ROOT_URI+"php/api/addVote.php?"+(variable("answerId",event.target.answerId.value));
	request.open("GET",uri,true)
	request.send(null);
	
}

function hideVoteButton(){
	var voteButton = document.getElementById("voteButton");
	voteButton.classList.add('hidden');
}

function AddSuccessMessage(message=""){
	var successMessage = document.getElementById("successMessage");

	successMessage.innerHTML = message;
}

function AddResult(poll)
{
	var answerString="";
	var totalVoteCount = getTotalVoteCount(poll);
	
	poll.answers.forEach((answer)=>{		
		answerString+=getAnswerCard(answer,totalVoteCount,true);		
	});
	document.getElementById("answer-container").innerHTML=answerString;
}