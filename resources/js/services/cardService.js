import axios from "./instance";

const prefix = "cards";

async function index()
{
	return await axios.get(prefix);
}

async function merge(cards, contacts)
{
	const formData = new FormData();
	formData.append("cards", cards)
	formData.append("contacts", contacts)
	return await axios.post(
		`${prefix}/merge`,
		formData,
		{
			headers: {'Content-Type': "multipart/form-data"}
		}
	);
}

export {index, merge};
