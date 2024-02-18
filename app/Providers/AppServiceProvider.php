<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Models\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share(/*değişken adı:*/'config',/*gelecek data*/Config::find(1));
        Route::resourceVerbs([
            'create'=>'olustur',
            'edit'=>'guncelle',
        ]);
    }
}
