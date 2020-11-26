import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";
import HandsonTable from "handsontable";
import Swal from "sweetalert2";

import {cardIndex, cardMerge} from "../../services/index";
import {forEach} from "lodash";

/******************************* MERGE **********************/
const button = document.getElementById("js-merge-submit");
button.addEventListener("click", handleSubmitMerge);

async function handleSubmitMerge(e)
{
	e.preventDefault();
	domClearCardsErrors();
	domClearMergedData();

	const cards = document.getElementById("js-cards").files[0];
	const contacts = document.getElementById("js-contacts").files[0];

	try 
	{
		const response = await cardMerge(cards, contacts);
		const merged = response.data.merged;
		domSetMergedData(JSON.stringify(merged));
		Swal.fire({
			title: "Merging Success",
			text: "Please refer to the table in Step 2 to review your imported data",
			icon: "success"
		});
	}
	catch(error)
	{
		const data = error.response.data;
		if(data.hasOwnProperty("errors"))
		{
			const errors = data.errors;
			let errorList = [];
			if(errors.hasOwnProperty("cards"))
			{
				errorList = [...errorList, ...errors.cards];
			}
			if(errors.hasOwnProperty("contacts"))
			{
				errorList = [...errorList, ...errors.contacts];
			}
			domSetFilesErrors(errorList);
			triggerErrorModal();
		}
	}
}

function triggerErrorModal()
{
	const elementErrorList = document.getElementById("js-import-errors").cloneNode(true);
	Swal.fire({
		title: "Given data is invalid",
		html: elementErrorList,
		icon: "error"
	});
}

function domSetFilesErrors(errors)
{
	console.log(errors)
	const domErrorList = document.getElementById("js-import-errors");
	errors.forEach(errorMessage => {
		const error = document.createElement("li");
		error.className = "list-group-item list-group-item-danger";
		error.innerText = errorMessage;
		domErrorList.appendChild(error);
	})
}

function domSetMergedData(mergedData)
{
	const field = document.getElementById("js-merged-vouchers-cards-hidden");
	field.value = mergedData;
	field.dispatchEvent(new Event('change'));
}

function domClearMergedData()
{
	const field = document.getElementById("js-merged-vouchers-cards-hidden");
	field.value = JSON.stringify([]);
	field.dispatchEvent(new Event('change'));
}

// Cleanup functions
function domClearCardsErrors()
{
	document.getElementById("js-import-errors").innerHTML = "";
}

/******************************* END MERGE **********************/

/******************************* REVIEW DATA **********************/
document.getElementById("js-merged-vouchers-cards-hidden").addEventListener('change', handleUpdateMergeData);
function handleUpdateMergeData(e)
{
	const mergeTableContainer = document.getElementById('js-merge-review-table')
	mergeTableContainer.innerHTML = "";
	const data = e.target.value;

	const colHeaders = [
		'Abbott Code',
		'Card Code',
		'First Name',
		'Last Name',
		'Phone Number'
	];

	const columns = [
		{data: 'abbott_code', editor: false},
		{data: 'card_code', editor: false},
		{data: 'first_name', editor: false},
		{data: 'last_name', editor: false},
		{data: 'phone_number', editor: false},
	]

	new HandsonTable(mergeTableContainer, {
		data: JSON.parse(data),
		stretchH: 'all',
		rowHeaders: true,
		colHeaders: colHeaders,
		columns: columns,
		height: "20rem",
		licenseKey: 'non-commercial-and-evaluation'
	})
}
/******************************* END REVIEW DATA **********************/
