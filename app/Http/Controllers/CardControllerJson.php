<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCards;
use App\Http\Services\CardService;
use App\Imports\CardImport;
use App\Models\Batch;
use App\Models\Card;
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

    public function import(ImportCards $request)
    {
		$cards_file = $request->file('cards');

		try 
		{
			Excel::import(new CardImport(), $cards_file);
			return response()->json([
				'success' => true
			]);
		}
		catch(ValidationException $e)
		{
			$failures = $e->failures();
			return response()->json([
				'failures' => $failures
			]);
		}
    }
}
