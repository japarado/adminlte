import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";
import HandsonTable from "handsontable";
import Swal from "sweetalert2";

import {cardIndex, parseCardCsvData, cardImport, cardAssignBrands} from "../../services/index";
import {forEach} from "lodash";

initializeReviewTable();

document.getElementById("js-import-submit").addEventListener("click", (e) => 
{
	e.preventDefault();
	domClearCardsErrors();

	initializeReviewTable();
	REVIEW_TABLE_DATA = [];
	initializeReviewTable();

	handleImport();
});

let REVIEW_TABLE;
let REVIEW_TABLE_DATA = [];

async function handleImport()
{
	const cards = document.getElementById("js-cards").files[0];
	try 
	{
		const response = await parseCardCsvData(cards);
		REVIEW_TABLE_DATA = response.data.cards;
		initializeReviewTable();
		Swal.fire({
			title: "Merging Success",
			text: "Please refer to the table in Step 2 to review your imported data",
			icon: "success"
		});
	}
	catch(error)
	{
		const data = error.response.data;
		if(Object.prototype.hasOwnProperty.call(data, "errors"))
		{
			const errors = data.errors;
			let errorList = [];
			if(Object.prototype.hasOwnProperty.call(errors, "cards"))
			{
				errorList = [...errorList, ...errors.cards];
			}
			domSetFilesErrors(errorList);
			triggerErrorModal();
		}
	}
}

function initializeReviewTable()
{
	const mergeTableContainer = document.getElementById("js-import-review-table");
	mergeTableContainer.innerHTML = "";

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
		{data: "first_name"},
		{data: "last_name"},
		{data: "phone_number"},
		{data: "brand"},
	];

	REVIEW_TABLE = new HandsonTable(mergeTableContainer, {
		data: REVIEW_TABLE_DATA,
		stretchH: "all",
		rowHeaders: true,
		colHeaders: colHeaders,
		columns: columns,
		height: "20rem",
		minSpareRows: 0,
		licenseKey: "non-commercial-and-evaluation",
	});
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
	errors.forEach((errorMessage) => 
	{
		const error = document.createElement("li");
		error.className = "list-group-item list-group-item-danger";
		error.innerText = errorMessage;
		domErrorList.appendChild(error);
	});
}

// Cleanup functions
function domClearCardsErrors()
{
	document.getElementById("js-import-errors").innerHTML = "";
}

document.getElementById("js-auto-assign-brands").addEventListener("click", handleAssignBrands);
async function handleAssignBrands(e) 
{
	if(e.target.checked)
	{
		const response = await cardAssignBrands(REVIEW_TABLE_DATA);
		REVIEW_TABLE_DATA = response.data.cards;
		initializeReviewTable();
	}
	else
	{
		REVIEW_TABLE_DATA = REVIEW_TABLE_DATA.map((card) => 
		{
			card.brand = null;
			return card;
		});
	}
	initializeReviewTable();
}
