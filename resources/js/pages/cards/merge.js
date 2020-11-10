import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";

import {cardIndex, cardMerge} from "../../services/index";
import {forEach} from "lodash";

const button = document.getElementById("js-merge-submit");

button.addEventListener("click", handleSubmitMerge);

async function handleSubmitMerge(e)
{
	e.preventDefault();

	domClearCardsErrors();
	domClearContactsErrors();

	const cards = document.getElementById("js-cards").files[0];
	const contacts = document.getElementById("js-contacts").files[0];

	try 
	{
		const response = await cardMerge(cards, contacts);
		console.log('success');
	}
	catch(e)
	{
		const response = e.response;
		// if(response.data.errors)
		if(response.data.hasOwnProperty("errors"))
		{
			const errors = response.data.errors;
			if(errors.hasOwnProperty('cards'))
			{
				setCardsErrors(errors.cards)
			}
			if(errors.hasOwnProperty('contacts'))
			{
				setContactsErrors(errors.contacts)
			}
		}
	}
}

function setCardsErrors(errors)
{
	document.getElementById("js-cards").classList.add("is-invalid");
	errors.forEach(error => domAddCardsError(error))
}

function setContactsErrors(errors)
{
	document.getElementById("js-contacts").classList.add("is-invalid");
	errors.forEach(error => domAddContactsError(error))
}

function domAddCardsError(message)
{
	const errorElement = elementCreateFormError(message)
	document.getElementById("js-cards-errors").insertAdjacentElement("afterend", errorElement)
}

function domAddContactsError(message)
{
	const errorElement = elementCreateFormError(message)
	document.getElementById("js-contacts-errors").insertAdjacentElement('afterend', errorElement);
}

function domClearCardsErrors()
{
	document.getElementById("js-cards").classList.add("is-invalid");
	document.getElementById("js-cards-errors").innerHTML = "";
}

function domClearContactsErrors()
{
	document.getElementById("js-contacts").classList.add("is-invalid");
	document.getElementById("js-contacts-errors").innerHTML = "";
}
