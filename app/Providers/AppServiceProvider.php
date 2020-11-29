<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Contact;
use App\Observers\CardObserver;
use App\Observers\ContactObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Paginator::useBootstrap();
		Contact::observe(ContactObserver);
		Card::observe(CardObserver::class);
    }
}
