import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";
import HandsonTable from "handsontable";
import Swal from "sweetalert2";

import {cardIndex, parseCardCsvData, cardImport, cardAssignBrands} from "../../services/index";
import {forEach} from "lodash";

document.getElementById("js-import-submit").addEventListener("click", (e) => {
	e.preventDefault();
	domClearCardsErrors();
	domClearParsedData();
	handleImport();
});

async function handleImport()
{
	const cards = document.getElementById("js-cards").files[0];
	try 
	{
		const response = await parseCardCsvData(cards);
		domSetParsedData(JSON.stringify(response.data.cards));
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
	console.log(errors);
	const domErrorList = document.getElementById("js-import-errors");
	errors.forEach((errorMessage) => {
		const error = document.createElement("li");
		error.className = "list-group-item list-group-item-danger";
		error.innerText = errorMessage;
		domErrorList.appendChild(error);
	});
}

function domGetParsedData()
{
	return JSON.parse(document.getElementById("js-parsed-results-hidden").value);
}

function domSetParsedData(mergedData)
{
	const field = document.getElementById("js-parsed-results-hidden");
	field.value = mergedData;
	field.dispatchEvent(new Event("change"));
}

function domClearParsedData()
{
	const field = document.getElementById("js-parsed-results-hidden");
	field.value = JSON.stringify([]);
	field.dispatchEvent(new Event("change"));
}

// Cleanup functions
function domClearCardsErrors()
{
	document.getElementById("js-import-errors").innerHTML = "";
}

/******************************* END MERGE **********************/

/******************************* REVIEW DATA **********************/
document.getElementById("js-parsed-results-hidden").addEventListener("change", handleUpdateMergeData);
function handleUpdateMergeData(e)
{
	const mergeTableContainer = document.getElementById("js-import-review-table");
	mergeTableContainer.innerHTML = "";
	const data = e.target.value;

	const colHeaders = [
		"Abbott Code",
		"Card Code",
		"First Name",
		"Last Name",
		"Phone Number",
		"Brand"
	];

	const columns = [
		{data: "abbott_code", editor: false},
		{data: "card_code", editor: false},
		{data: "first_name", editor: true},
		{data: "last_name", editor: true},
		{data: "phone_number", editor: true},
		{data: "brand", editor: false},
	];

	new HandsonTable(mergeTableContainer, {
		data: JSON.parse(data),
		stretchH: "all",
		rowHeaders: true,
		colHeaders: colHeaders,
		columns: columns,
		height: "20rem",
		licenseKey: "non-commercial-and-evaluation",
		afterChange: (changes, source) => {console.table(changes); console.log(source);}
	});
}
/******************************* END REVIEW DATA **********************/

document.getElementById("js-auto-assign-brands").addEventListener("click", handleAssignBrands);

async function handleAssignBrands(e) 
{
	const cards = domGetParsedData();
	if(e.target.checked)
	{
		const response = await cardAssignBrands(cards);
		domSetParsedData(JSON.stringify(response.data.cards));
	}
	else
	{
		const cardsWithRemovedBrands = cards.map((card) => {card.brand = null; return card;});
		domSetParsedData(JSON.stringify(cardsWithRemovedBrands));
	}
}
