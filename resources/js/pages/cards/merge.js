import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";
import HandsonTable from "handsontable";

import {cardIndex, cardMerge} from "../../services/index";
import {forEach} from "lodash";

/******************************* MERGE **********************/
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
		const merged = response.data.merged;
		domSetMergedData(JSON.stringify(merged));
	}
	catch(error)
	{
		console.log(error);
		const response = error.response;
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
	document.getElementById("js-cards").classList.remove("is-invalid");
	document.getElementById("js-cards-errors").innerHTML = "";
}

function domClearContactsErrors()
{
	document.getElementById("js-contacts").classList.remove("is-invalid");
	document.getElementById("js-contacts-errors").innerHTML = "";
}

function domSetMergedData(mergedData)
{
	const field = document.getElementById("js-merged-vouchers-cards-hidden");
	field.value = mergedData;
	field.dispatchEvent(new Event('change'));
}

/******************************* END MERGE **********************/

/******************************* REVIEW DATA **********************/
document.getElementById("js-merged-vouchers-cards-hidden").addEventListener('change', handleUpdateMergeData);
function handleUpdateMergeData(e)
{
	const mergeTableContainer = document.getElementById('js-merge-review-table')
	const data = e.target.value;

	const colHeaders = [
		'Abbott Code',
		'Card Code',
		'First Name',
		'Last Name',
		'Phone Number'
	];

	const columns = [
		{data: 'abbott_code'},
		{data: 'card_code'},
		{data: 'first_name'},
		{data: 'last_name'},
		{data: 'phone_number'},
	]

	new HandsonTable(mergeTableContainer, {
		data: JSON.parse(data),
		stretchH: 'all',
		rowHeaders: true,
		colHeaders: colHeaders,
		columns: columns,
		licenseKey: 'non-commercial-and-evaluation'
	})
}
/******************************* END REVIEW DATA **********************/
