<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCards;
use App\Http\Services\CardService;
use App\Imports\CardImport;
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

    public function import(ImportCards $request)
    {
		$cards_file = $request->file('cards');

		Excel::import(new CardImport(), $cards_file);
		return response()->json([
			'merged' => []
		]);
    }
}
