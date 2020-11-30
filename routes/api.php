<?php

use App\Http\Controllers\CardControllerJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([])->group(function () {
    Route::prefix('cards')->group(function () {
        Route::post('assign-brands', [CardControllerJson::class, 'assignBrands'])->name('api.cards.assign-brands');
        Route::post('parse-csv-data', [CardControllerJson::class, 'parseCsvData'])->name('api.cards.parse-csv-data');
        Route::post('import', [CardControllerJson::class, "import"])->name('api.cards.import');
    });

    Route::resource('cards', CardControllerJson::class, ['as' => 'api.cards'])->parameter('cards', 'id');
});
