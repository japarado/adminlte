<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCards;
use App\Http\Requests\ParseCardCsv;
use App\Http\Services\CardService;
use App\Imports\CardImport;
use App\Models\Batch;
use App\Models\Card;
use Error;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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

    public function parseCsvData(ParseCardCsv $request)
    {
        $card_import_results = Excel::toCollection(new CardImport(), $request->file('cards'))[0];

        $cards = [];

        foreach ($card_import_results as $card) {
            $named_card = [
                    'abbott_code' => $card[0],
                    'card_code' => $card[1],
                    'first_name' => $card[2],
                    'last_name' => $card[3],
                    'phone_number' => $card[4],
                ];
            array_push($cards, $named_card);
        }

        return response()->json([
            'cards' => $cards
        ]);
    }

    public function import(Request $request)
    {
    }
}
