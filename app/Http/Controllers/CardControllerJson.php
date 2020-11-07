<?php

namespace App\Http\Controllers;

use App\Http\Requests\MergeCards;
use App\Imports\CardImport;
use App\Models\AbbottCode;
use App\Models\Batch;
use App\Models\Card;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Str;

class CardControllerJson extends Controller
{
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

        $abbott_code = self::getAbbottCode($request);

        $batch = Batch::create([
            'code' => Str::random(30),
            'import_type' => "VOUCHER",
            'user_id' => 2,
        ]);

        $cards = Excel::toCollection(new CardImport($batch, $abbott_code), $cards_file);

		dd($cards);

        return response()->json(['cards' => $cards]) ;
    }

    private static function getAbbottCode(Request $request)
    {
        $abbott_code = null;
        if ($request->input('abbott_code_id')) {
            $abbott_code = AbbottCode::find($request->input('abbott_code_id'));
		}
	   	else {
            $abbott_code = AbbottCode::first();
        }
        return $abbott_code;
    }
}
