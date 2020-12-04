<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Voucher;

class HomeController extends Controller
{
	public function index()
	{
		$context = [
			'voucher_total_count' => Voucher::all()->count(),
			'voucher_paired_count' => Voucher::has('contact')->get()->count(),

			'card_total_count' => Card::all()->count(),
			'card_paired_count' => Card::has('contact')->get()->count(),
		];
		return view('home', $context);
	}
}
