const minAnswerCount =2;
const maxAnswerCount = 5;
const answerCharLimit = 50;
const questionCharLimit = 100;
document.addEventListener("DOMContentLoaded", function(event){
	document.getElementById("addAnswer").addEventListener("click", addAnswer);
	document.getElementById("removeAnswer").addEventListener("click", removeAnswer);
	document.getElementById("createPollForm").addEventListener("submit", checkCreatePollForm);
	document.getElementById("title").addEventListener("blur", checkTitle);
	document.getElementById("openDate").addEventListener("blur", checkOpenDate);
	document.getElementById("closeDate").addEventListener("blur", checkCloseDate);
	document.getElementById("question").addEventListener("blur", checkQuestion);

	document.getElementById("question").addEventListener("input", (event)=>{
		setCharCount(event,questionCharLimit);
	},false);
	var answerArry = document.getElementsByClassName("answer");
	for (var i = 0; i < 2; i++) {
		addAnswer();
	}
	for (var i = 0; i < answerArry.length; i++) {
		addAnswerEvent(answerArry[i]);
	}

});

function addAnswerEvent(answer){
	answer.addEventListener("blur", checkAnswer);			
	answer.addEventListener("input", (event)=>{
		setCharCount(event,answerCharLimit);
	}, false)
}

function addAnswer(event)
{
	console.log("addAnswer is fired");
	var newAnswerIndex = getAnswerCount()+1;	
	if(newAnswerIndex>maxAnswerCount){
		document.getElementById("maxAnswerMsg").classList.remove("hidden");
		return;
	}
	else{
		document.getElementById("maxAnswerMsg").classList.add("hidden");
	}
	var newAnswer = document.createElement("DIV");                 
	newAnswer.innerHTML = `
	<div class="row">
	<div class="col-3"></div>
	<label class="form-label col-4 " for="answer`+newAnswerIndex+`">Answer`+newAnswerIndex+`</label>
	</div>
	<div class="row">
	<div class="col-3 text-right"></div>
	<div class="col-6 pad-0 textarea">
	<textarea class="form-input answer" rows="3" name="answer`+newAnswerIndex+`" id="answer`+newAnswerIndex+`"></textarea>
	<p class="char-count mr-0">char:
	<span id="answer`+newAnswerIndex+`_count">
	0
	</span>
	<span>
	/50
	</span>
	</p>
	</div>
	<p class="form-error col-3 hidden" id="answer`+newAnswerIndex+`_msg">Must be 1 to 50 characters long</p>
	</div>
	`;  
	
	document.getElementById("answerContainer").appendChild(newAnswer);
	//document.getElementById("answer"+newAnswerIndex).addEventListener("blur",checkAnswer,false);
	addAnswerEvent(document.getElementById("answer"+newAnswerIndex));
	//addAnswerEvent(newAnswer);
}

function getAnswerCount()
{
	return document.getElementsByClassName("answer").length;
}

function checkCreatePollForm(event)
{
	var isOK = true;
	isOK&=checkTitle(event);
	isOK&=checkOpenDate(event);
	isOK&=checkCloseDate(event);
	isOK&=checkQuestion(event);
	isOK&=checkAllAnswers(event);
	
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
	return checkField(event.target, /^.{1,50}$/, event);
}

function checkAllAnswers(event)
{
	var isOK = true;
	var answerArry = document.getElementsByClassName("answer");
	for (var i = answerArry.length - 1; i >= 0; i--) {
		isOK &= checkField(answerArry[i], /^.{1,50}$/, event);
	}
	isOK &= answerArry.length <=5 && answerArry.length >=2;
	return isOK;
}

function resetForm()
{
	document.getElementById("createPollForm").reset();
	document.getElementById("answerContainer").innerHTML ="";
	for (var i = 0; i < 2; i++) {
		addAnswer();
	}
	var errors = document.getElementsByClassName("form-error");
	for (var i = errors.length - 1; i >= 0; i--) {
		errors[i].classList.add("hidden");
	}
}

function removeAnswer()
{
	var answerContainer =document.getElementById("answerContainer");
	if(answerContainer.children.length > minAnswerCount){
		answerContainer.lastChild.remove();
		document.getElementById("minAnswerMsg").classList.add("hidden");
	}else{
		document.getElementById("minAnswerMsg").classList.remove("hidden");
	}	

}