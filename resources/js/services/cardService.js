import axios from "./instance";

const prefix = "cards";

async function index()
{
	return await axios.get(prefix);
}

async function importCards(cards)
{
	const formData = new FormData();
	formData.append("cards", cards)
	return await axios.post(
		`${prefix}/import`,
		formData,
		{
			headers: {'Content-Type': "multipart/form-data"}
		}
	);
}

export {index, importCards};
