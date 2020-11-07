function elementCreateFormError(message)
{
	const errorMessage = document.createElement("div")
	errorMessage.classList = "invalid-feedback";
	errorMessage.innerText = message;

	return errorMessage;
}

export {elementCreateFormError};
