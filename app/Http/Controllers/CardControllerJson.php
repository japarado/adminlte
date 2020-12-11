<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignBrands;
use App\Http\Requests\ImportCards;
use App\Http\Requests\ParseCardCsv;
use App\Http\Services\CardService;
use App\Imports\CardImport;
use App\Jobs\ProcessCards;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\Card;
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
        $cards = Card::paginate(config('constants.STANDARD_PAGE_SIZE'));

        $context = [
            'cards' => $cards,
        ];

        return response()->json($context);
    }

    public function parseCsvData(ParseCardCsv $request)
    {
        $card_import_results = Excel::toArray(new CardImport(), $request->file('cards'))[0];

        $card_code_cache = [];
        $duplicated_cards = [];
        $cards = [];

        foreach ($card_import_results as $row) {
            $card = [
                'abbott_code' => $row[0],
                'card_code' => $row[1],
                'first_name' => $row[2],
                'last_name' => $row[3],
                'phone_number' => $row[4],
                'email' => $row[5],
            ];

			if (in_array($row[1], $card_code_cache)) 
			{
                array_push($duplicated_cards, $card);
			}
		   	else {
                array_push($card_code_cache, $row[1]);
                array_push($cards, $card);
            }
        }

        return response()->json([
            'cards' => $cards,
            'duplicated_cards' => $duplicated_cards
        ]);
    }

    public function assignBrands(AssignBrands $request)
    {
        $cards = $request->input('cards');

        $brand_by_code = [];

        $brands = Brand::with('brandCodes')->get();
        foreach ($brands as $brand) {
            foreach ($brand->brandCodes as $brand_code) {
                $brand_by_code[$brand_code->code] = [
                    'brand_name' => $brand->name,
                    'brand_id' => $brand->id
                ];
            }
        }

        $return_value = [];

        foreach ($cards as $card) {
            $brand_code = substr($card['card_code'], 0, 4);
            if (array_key_exists($brand_code, $brand_by_code)) {
                $card['brand_name'] = $brand_by_code[$brand_code]['brand_name'];
                $card['brand_id'] = $brand_by_code[$brand_code]['brand_id'];
                array_push($return_value, $card);
            }
        }

        return response()->json([
            'cards' => $return_value
        ]);
    }

    public function import(ImportCards $request)
    {
        $rows = $request->input('rows');
        $fallback_brand_id = $request->input('fallback_brand_id');

        $batch = Batch::create([
            'import_type' => config('constants.IMPORT_TYPES.card'),
            'user_id' => 1,
            'data' => $rows
        ]);

		ProcessCards::dispatch($rows, $fallback_brand_id, $batch);

        return response()->json([
            'cards' => $rows,
            'fallback_brand_id' => $fallback_brand_id
        ]);
    }
}
