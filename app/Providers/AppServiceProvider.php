<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if (! Builder::hasMacro('count')) {

        //   Builder::macro('count', function () {
        //       $raw = $this->engine()->search($this);

        //       return (int) $raw['nbHits'];
        //   });

        // }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
