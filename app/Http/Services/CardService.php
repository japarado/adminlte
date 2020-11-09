<?php
namespace App\Http\Services;

use App\Classes\CardContactMergeItem;
use App\Imports\CardMergeImport;
use App\Imports\ContactMergeImport;
use Maatwebsite\Excel\Facades\Excel;

class CardService {

	public function merge($cards_file, $contacts_file): array
	{
		$cards_import_res = Excel::toArray(new CardMergeImport(), $cards_file);
		$contacts_import_res = Excel::toArray(new ContactMergeImport(), $contacts_file);

		$cards = $cards_import_res[0];
		$contacts = $contacts_import_res[0];

		return self::mergeContactsAndCards($cards, $contacts);
	}

	private static function mergeContactsAndCards($cards, $contacts): array
	{
		$return_value = [];
		for($ctr = 0; $ctr < max(count($cards), count($contacts)); $ctr++)
		{
			$merge_item = new CardContactMergeItem();
			if(array_key_exists($ctr, $cards))
			{
				$card = $cards[$ctr];

				$merge_item->abbott_code = array_key_exists(0, $card) ? $card[0] : "";
				$merge_item->card_code = array_key_exists(1, $card) ? $card[1] : "";
			}

			if(array_key_exists($ctr, $contacts))
			{
				$contact = $contacts[$ctr];

				$merge_item->last_name = array_key_exists(0, $contact) ? $contact[0] : "";
				$merge_item->first_name = array_key_exists(1, $contact) ? $contact[1] : "";
				$merge_item->phone_number = array_key_exists(2, $contact) ? $contact[2] : "";
			}

			array_push($return_value, $merge_item);
		}

		return $return_value;
	}
}
