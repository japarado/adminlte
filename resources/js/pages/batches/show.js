import HandsonTable from "handsontable";

const TABLE_DATA = JSON.parse(document.getElementById("js-import-data").value);

displayTable();

function displayTable()
{
	const container = document.getElementById("js-import-data-table");

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
		{data: "first_name", editor: false},
		{data: "last_name", editor: false},
		{data: "phone_number", editor: false},
		{data: "email", editor: false},
		{data: "brand_name", editor: false},
	];

	new HandsonTable(container, {
		data: TABLE_DATA,
		stretchH: "all",
		rowHeaders: true,
		colHeaders: colHeaders,
		columns: columns,
		height: "20rem",
		minSpareRows: 0,
		licenseKey: "non-commercial-and-evaluation",
	});
}

