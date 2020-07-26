document.addEventListener("DOMContentLoaded", function(event){
		console.log("adding event handlers");
		document.getElementById("loginForm").addEventListener("submit", checkLogin,false);
		document.getElementById("email").addEventListener("blur",checkEmail,false);
		document.getElementById("password").addEventListener("blur",checkPassword,false);
});

function checkEmail(event)
{
	const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	return checkField(document.getElementById("email"), emailRegex, event);
}

function checkPassword(event)
{
	const passwordRegex = /^.{8,}$/;
	var field = document.getElementById("password");
	var isOK = true;
	isOK&=/^[^\s]{8,}$/.test(field.value);
	return checkField(document.getElementById("password"), passwordRegex, event, isOK);
}

function checkLogin(event)
{	
	var isOK = true;
	isOK = isOK& checkEmail(event);
	isOK = isOK& checkPassword(event);
	return isOK;
}
