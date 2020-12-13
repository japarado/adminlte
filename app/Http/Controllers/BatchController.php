<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\CardBatch;
use App\Models\VoucherBatch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::with('user')
            ->withCount(['cards' => function ($query) {
                $query->withCount('contact');
            }])
            ->withCount('vouchers')
            ->orderBy('id', 'desc')
            ->paginate(config('constants.STANDARD_PAGE_SIZE'));

        $context = [
            'batches' => $batches
        ];

        return view('batches.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$plain_batch = Batch::find($id);

		if($plain_batch->import_type === config('constants.IMPORT_TYPES.card'))
		{
			$batch_query = CardBatch::with(['cards' => function($query) {
				$query->withCount('contact');
			}]);
		}
		else 
		{
			$batch_query = VoucherBatch::with(['vouchers' => function($query) {
				$query->withCount('contact');
			}]);
		}

		$batch = $batch_query->with('rejectedContacts')->find($id);

		$batch->contact_count = 0;
		foreach($batch->cards as $card)
		{
			$batch->contact_count += $card->contact_count;
		}

		$import_file_card_count = count($batch->data['rows']);

		$card_insertion_rate = round((count($batch->cards) / count($batch->data['rows'])) * 100, 2);
		$contact_insertion_rate = round(($batch->contact_count / $batch->data['contact_count']) * 100, 2);
		
        $context = [
            'batch' => $batch,
			'card_insertion_rate' => $card_insertion_rate,
			'contact_insertion_rate' => $contact_insertion_rate,
			'import_file_card_count' => $import_file_card_count,
			'import_type' => ucfirst(strtolower($batch->import_type)),
        ];

        return view('batches.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
