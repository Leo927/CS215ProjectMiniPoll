document.addEventListener("DOMContentLoaded", function(event){
	document.getElementById("addAnswer").addEventListener("click", addAnswer);
	document.getElementById("createPollForm").addEventListener("submit", checkCreatePollForm);
	document.getElementById("title").addEventListener("blur", checkTitle);
	document.getElementById("openDate").addEventListener("blur", checkOpenDate);
	document.getElementById("closeDate").addEventListener("blur", checkCloseDate);
	document.getElementById("question").addEventListener("blur", checkQuestion);
	var answerArry = document.getElementsByClassName("answer");
	for (var i = 0; i < answerArry.length; i++) {
		answerArry[i].addEventListener("blur", checkAnswer);			
	}

});

function addAnswer(event)
{
	console.log("addAnswer is fired");
	var newAnswerIndex = getAnswerCount()+1;	
	if(newAnswerIndex>5)
	{
		event.target.nextElementSibling.classList.remove("hidden");
		return;
	}
	var newAnswer = document.createElement("DIV");                 
	newAnswer.innerHTML = `
			<div class="row">
				<div class="col-3"></div>
				<label class="form-label col-4 " for="answer`+newAnswerIndex+`">Answer`+newAnswerIndex+`</label>
			</div>
			<div class="row">
				<div class="col-3 text-right"></div>
				<textarea class="form-input col-6 answer" rows="3" name="answer`+newAnswerIndex+`" id="answer`+newAnswerIndex+`"></textarea> 
				<p class="form-error col-3 hidden">Must be 1 to 50 characters long</p>
			</div>
		`;  
	
	document.getElementById("answerContainer").appendChild(newAnswer);
	document.getElementById("answer"+newAnswerIndex).addEventListener("blur",checkAnswer,false);
}

function getAnswerCount()
{
	return document.getElementsByClassName("answer").length;
}

function checkCreatePollForm(event)
{
	event.preventDefault();
	var isOK = true;
	isOK&=checkTitle(event);
	isOK&=checkOpenDate(event);
	isOK&=checkCloseDate(event);
	isOK&=checkQuestion(event);
	isOK&=checkAllAnswers(event);
	if(isOK){
		var successMsgs =  document.getElementsByClassName("succcess-message");
		for (var i = successMsgs.length - 1; i >= 0; i--) {
			successMsgs[i].classList.remove("hidden");
		}
		event.target.reset();
	}
	else
	{

	}
	return isOK;
}

function checkTitle(event)
{
	return checkField(document.getElementById("title"), /^.{1,50}$/, event);
}

function checkOpenDate(event)
{
	return checkDateField(document.getElementById("openDate"), event);
}

function checkCloseDate(event)
{
	return checkDateField(document.getElementById("closeDate"), event);
}

function checkQuestion(event)
{
	return checkField(document.getElementById("question"), /^.{1,100}$/, event);
}

function checkAnswer(event)
{
	console.log("checkAnswer is fired");
	return checkField(event.target, /^.{1,50}$/, event);
}

function checkAllAnswers(event)
{
	var isOK = true;
	var answerArry = document.getElementsByClassName("answer");
	for (var i = answerArry.length - 1; i >= 0; i--) {
		isOK &= checkField(answerArry[i], /^.{1,50}$/, event);
	}
	return isOK;
}