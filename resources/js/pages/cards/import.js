import axios from "../../services/instance";
import {elementCreateFormError} from "../../utils";
import HandsonTable from "handsontable";
import Swal from "sweetalert2";

import {cardIndex, parseCardCsvData, cardImport, cardAssignBrands} from "../../services/index";
import {forEach} from "lodash";

let REVIEW_TABLE;
let REVIEW_TABLE_DATA = [];
const BRANDS = JSON.parse(document.getElementById("js-brands").value);

initializeReviewTable();

document.getElementById("js-parse-submit").addEventListener("click", (e) => 
{
	e.preventDefault();
	domClearCardsErrors();
	REVIEW_TABLE_DATA = [];
	initializeReviewTable();

	handleClickParse();
});


async function handleClickParse()
{
	const cards = document.getElementById("js-cards").files[0];

	// Set the "Auto-assign brands"  checkbox back to unchecked
	document.getElementById("js-auto-assign-brands").checked = false;
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
		"Email",
		"Brand"
	];

	const columns = [
		{data: "abbott_code", editor: false},
		{data: "card_code", editor: false},
		{data: "first_name"},
		{data: "last_name"},
		{data: "phone_number"},
		{data: "email"},
		{
			data: "brand_name",
			type: "dropdown",
			source: BRANDS.map((brand) => brand.name),
			allowInvalid: false
		},
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
		afterChange: handleUpdateTable
	});
}

function handleUpdateTable(changes, source)
{
	if(changes && source)
	{
		changes.forEach(([row, prop, oldValue, newValue]) => 
		{
			if(oldValue !== newValue)
			{
				if(prop === "brand_name")
				{
					document.getElementById("js-auto-assign-brands").checked = false;
					const edited_data = REVIEW_TABLE_DATA.map((card, index) => 
					{
						if(index === row)
						{
							card.brand_id = BRANDS.find((brand) => brand.name === newValue).id;
						}

						return card;
					});

					REVIEW_TABLE_DATA = edited_data;
				}
			}
		});
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

document.getElementById("js-auto-assign-brands").addEventListener("click", handleTickAutoAssignBrands);
async function handleTickAutoAssignBrands(e) 
{
	if(e.target.checked)
	{
		const response = await cardAssignBrands(REVIEW_TABLE_DATA);
		REVIEW_TABLE_DATA = response.data.cards;
	}
	else
	{
		REVIEW_TABLE_DATA = REVIEW_TABLE_DATA.map((card) => 
		{
			card.brand_name = null;
			card.brand_id = null;
			return card;
		});
	}
	initializeReviewTable();
	document.getElementById("js-fallback-brand-id").dispatchEvent(new Event("change"));
}

document.getElementById("js-fallback-brand-id").addEventListener("change", handleSelectFallbackBrand);
function handleSelectFallbackBrand(e)
{
	const option = e.target.options[e.target.selectedIndex];
	const brandName = option.dataset.brandName;
	const brandId = e.target.value;

	const rowsWithEmptyBrands = REVIEW_TABLE_DATA.filter((card) => !card.brand_id && !card.brand_name);

	if(rowsWithEmptyBrands.length > 0)
	{
		REVIEW_TABLE_DATA = REVIEW_TABLE_DATA.map((card) =>
		{
			if(!card.brand)
			{
				card.brand_name = brandName;
				card.brand_id = brandId;
			}
			return card;
		});
		initializeReviewTable();
	}
	else 
	{
		console.log("No cards requiring fallbacks brands were found");
	}
}

document.getElementById("js-import-submit").addEventListener("click", handleClickImport);

async function handleClickImport(e)
{
	e.preventDefault();

	const choice = await Swal.fire({
		icon: "question",
		title: "Import now?",
		showConfirmButton: true,
		showCancelButton: true,
		showLoaderOnConfirm: true,
		allowOutsideClick: false,
		preConfirm: async(x) => 
		{
			domClearValidationErrors();
			domHideErrorsCard();
			try 
			{
				const fallbackBrandId = document.getElementById("js-fallback-brand-id").value;
				document.getElementById("js-fallback-brand-id").dispatchEvent(new Event("change"));
				await cardImport(REVIEW_TABLE_DATA, fallbackBrandId);
				Swal.fire({
					icon: "success",
					text: "Import successfully issued",
				});
			}
			catch(error)
			{
				const errors = error.response.data.errors;
				Swal.fire({
					icon: "error",
					title: "Validation errors detected",
					text: "Review the errors listed on the table below and reattempt the import"
				});
				domSetValidationErrors(errors, true);
			}
		}
	});
}

function domSetValidationErrors(errors, emitEvent = false)
{
	const errorList = [];
	Object.keys(errors).forEach((error) =>
	{
		const [fieldType, row, field] = error.split(".");
		const errorMessage = errors[error][0];
		const customizedMessage = errorMessage.replace(`The ${fieldType}.${row}.${field}`, field);
		errorList.push({row, field, message: customizedMessage});
	});

	document.getElementById("js-validation-errors").value = JSON.stringify(errorList);

	if(emitEvent)
	{
		document.getElementById("js-validation-errors").dispatchEvent(new Event("change"));
	}
}

function domClearValidationErrors(emitEvent = false)
{
	document.getElementById("js-validation-errors").value = "";
	if(emitEvent)
	{
		document.getElementById("js-validation-errors").dispatchEvent(new Event("change"));
	}
}

document.getElementById("js-validation-errors").addEventListener("change", handleUpdateValidationErrors);
function handleUpdateValidationErrors(e)
{
	domHideErrorsCard();
	const errors = JSON.parse(e.target.value);
	if(errors.length > 0)
	{
		domShowErrorsCard(errors);
	}
	else 
	{
		domHideErrorsCard(errors);
	}
}

function domHideErrorsCard()
{
	document.getElementById("js-error-card").classList.add("d-none");
	document.getElementById("js-error-table").getElementsByTagName("tbody")[0].innerHTML = null;
}

function domShowErrorsCard(errors)
{
	document.getElementById("js-error-card").classList.remove("d-none");
	const table = document.getElementById("js-error-table");

	errors.forEach((error, index) => 
	{
		const row = table.getElementsByTagName("tbody")[0].insertRow();

		const indexCell = row.insertCell();
		indexCell.innerText = index;

		const rowCell = row.insertCell();
		rowCell.innerText = error.row;

		const fieldCell = row.insertCell();
		fieldCell.innerText = error.field;

		const messageCell = row.insertCell();
		messageCell.innerText = error.message;
	});
}
