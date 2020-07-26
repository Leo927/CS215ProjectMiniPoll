
function setCharCount(event, charLimit)
{

	var count = document.getElementById(event.target.id+"_count");
	console.log(count);
	var length = event.target.value.length;
	count.textContent = length;
	if(length > charLimit){
		count.classList.add("danger");
	}
	else{
		count.classList.remove("danger");
	}

}

