import axios from "./instance";

const prefix = "cards";

async function index()
{
	return await axios.get(prefix);
}

async function parseCsvData(cards) 
{
	const formData = new FormData();
	formData.append("cards", cards);
	return await axios.post(
		`${prefix}/parse-csv-data`,
		formData,
		{
			headers: {"Content-Type": "multipart/form-data"}
		}
	);
}

async function assignBrands(cards)
{
	return await axios.post(`${prefix}/assign-brands`, {cards});
}

async function importCards(cards, fallbackBrandId = undefined)
{
	return await axios.post(`${prefix}/import`, {cards, fallback_brand_id: fallbackBrandId});
}

export {index, parseCsvData, assignBrands, importCards};
