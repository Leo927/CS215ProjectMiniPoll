document.addEventListener("DOMContentLoaded", function(event){
		console.log("adding event handlers");
		document.getElementById("loginForm").addEventListener("submit", checkLogin,false);
		document.getElementById("email").addEventListener("change",checkEmail,false);
		document.getElementById("password").addEventListener("change",checkPassword,false);
});

function checkEmail(event)
{
	const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	return checkField(document.getElementById("email"), emailRegex, event);
}

function checkPassword(event)
{
	const passwordRegex = /^.{8,}$/
	return checkField(document.getElementById("password"), passwordRegex, event);
}

function checkLogin(event)
{	
	var isOK = true;
	isOK = isOK& checkEmail(event);
	isOK = isOK& checkPassword(event);
	return isOK;
}
