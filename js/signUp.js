document.addEventListener("DOMContentLoaded", function(event){
		console.log("adding event handlers");
		document.getElementById("signUpForm").addEventListener("submit", checkLogin,false);
		document.getElementById("email").addEventListener("blur",checkEmail,false);
		document.getElementById("password").addEventListener("blur",checkPassword,false);
		document.getElementById("screenName").addEventListener("blur",checkScreenName,false);
		document.getElementById("repeatPassword").addEventListener("blur",checkRepeatPassword,false);
});

function checkEmail(event)
{
	const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	return checkField(document.getElementById("email"), emailRegex, event);
}



function checkPassword(event)
{
	const passwordRegex = /^.{8}$/;
	var field = document.getElementById("password");
	var isOK =true;
	isOK&= (/[\W\d]+/.test(field.value));
	return checkField(field, passwordRegex, event, isOK);
}

function checkScreenName(event)
{
	var field = document.getElementById("screenName");
	const screenNameRegex = /^.{1,}$/;
	var isOK =true;
	isOK&= !(/\s/.test(field.value));
	isOK&= !(/\W/.test(field.value));
	return checkField(document.getElementById("screenName"), screenNameRegex, event, isOK);
}

function checkRepeatPassword(event)
{
	const passwordRegex = /./;
	var repeatPassword = document.getElementById("repeatPassword");
	var password = document.getElementById("password");
	return checkField(repeatPassword, passwordRegex, event, repeatPassword.value == password.value);
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
	if(isOK){
		event.preventDefault();
		window.location.href ="htmls/management.html";
	}
	return isOK;
}
