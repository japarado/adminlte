<?php

namespace App\Http\Controllers;

use App\Http\Requests\MergeCards;
use App\Http\Services\CardService;
use App\Imports\CardMergeImport;
use App\Imports\ContactMergeImport;
use App\Models\AbbottCode;
use App\Models\Card;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CardControllerJson extends Controller
{
    public function __construct()
    {
        $this->card_service = new CardService();
    }

    private CardService $card_service;


    public function index()
    {
        $data = [
            'cards' => Card::paginate(config('constants.STANDARD_PAGE_SIZE')),
        ];

        return response()->json($data);
    }

    public function merge(MergeCards $request)
    {
        $cards_file = $request->file('cards');
        $contacts_file = $request->file('contacts');

        $merged = $this->card_service->merge($cards_file, $contacts_file);

		return response()->json([
			'success' => true
		]);

        return response()->json([
            'merged' => $merged
        ]) ;
    }
}
