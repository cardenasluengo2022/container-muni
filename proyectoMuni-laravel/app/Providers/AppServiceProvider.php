<?php

namespace App\Providers;
use Carbon\Carbon;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;
use App\DragDropFormField;
use App\MultipleRadioButtonFormField;
use App\CustomDateFormField;
use App\CustomTimeFormField;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        If (env('APP_ENV') !== 'local') {
            //$this->app['request']->server->set('HTTPS', true);
            \URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('es_ES');
        Voyager::addFormField(DragDropFormField::class);
        Voyager::addFormField(MultipleRadioButtonFormField::class);
        Voyager::addFormField(CustomDateFormField::class);
        Voyager::addFormField(CustomTimeFormField::class);
    }
}
