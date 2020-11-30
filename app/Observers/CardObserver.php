<?php

namespace App\Observers;

use App\Http\Services\CardService;
use App\Models\Card;

class CardObserver
{
    /**
     * Handle the Card "created" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function created(Card $card)
    {
        /* $suitable_brand = CardService::findBrandByCardCode($card->code_prefix); */
        /* if ($suitable_brand) { */
        /*     $card->brand_id = $suitable_brand->id; */
        /*     $card->is_code_valid = true; */
        /* } else { */
        /*     $card->is_code_valid = false; */
        /* } */
        /* $card->save(); */
    }

    /**
     * Handle the Card "updated" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function updated(Card $card)
    {
        //
    }

    /**
     * Handle the Card "deleted" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function deleted(Card $card)
    {
        //
    }

    /**
     * Handle the Card "restored" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function restored(Card $card)
    {
        //
    }

    /**
     * Handle the Card "force deleted" event.
     *
     * @param  \App\Models\Card  $card
     * @return void
     */
    public function forceDeleted(Card $card)
    {
        //
    }
}
