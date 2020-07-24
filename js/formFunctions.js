function checkGenericField(field,event,isOK)
{
	if(isOK){
		field.classList.remove("input-error");
		field.nextElementSibling.classList.add("hidden");
		return true;
	}
	else{
		field.classList.add("input-error");
		field.nextElementSibling.classList.remove("hidden");
		if(event!=null)
			event.preventDefault();
		return false;
	}
}

function checkField(field, regex, event){
	return checkGenericField(field,event,regex.test(field.value));
}

function checkDateField(field, event)
{
	return checkGenericField(field,event,isDate(field.value) );
}

function isDate(value) {
    switch (typeof value) {
        case 'number':
            return true;
        case 'string':
            return !isNaN(Date.parse(value));
        case 'object':
            if (value instanceof Date) {
                return !isNaN(value.getTime());
            }
        default:
            return false;
    }
}