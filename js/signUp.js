document.addEventListener("DOMContentLoaded", function(event){
		console.log("adding event handlers");
		document.getElementById("signUpForm").addEventListener("submit", checkLogin,false);
		document.getElementById("email").addEventListener("change",checkEmail,false);
		document.getElementById("password").addEventListener("change",checkPassword,false);
		document.getElementById("screenName").addEventListener("change",checkScreenName,false);
		document.getElementById("repeatPassword").addEventListener("change",checkRepeatPassword,false);
});

function checkEmail(event)
{
	const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	return checkField(document.getElementById("email"), emailRegex, event);
}



function checkPassword(event)
{
	const passwordRegex = /^.{8,}$/;
	return checkField(document.getElementById("password"), passwordRegex, event);
}

function checkScreenName(event)
{
	const screenNameRegex = /^.{2,}$/;
	return checkField(document.getElementById("screenName"), screenNameRegex, event);
}

function checkRepeatPassword(event)
{
	const passwordRegex = /^.{8,}$/;
	return checkField(document.getElementById("repeatPassword"), passwordRegex, event);
}

function checkAvator(event)
{
	var isSelected = event.target.avator.value!=null;
	if(isSelected)
	{
		console.log("avator selected is: "+event.target.avator.value);
	}
	return isSelected;
}

function checkLogin(event)
{	
	var isOK = true;
	isOK = isOK& checkEmail(event);
	isOK = isOK& checkPassword(event);
	isOK = isOK& checkScreenName(event);
	isOK = isOK& checkRepeatPassword(event);
	isOK = isOK& checkAvator(event);
	return isOK;
}
