<?php

namespace App\Providers;

use App\Model\Metas;
use Illuminate\Cache\DatabaseStore;
use Illuminate\Foundation\Testing\Constraints\HasInDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('zh');
        if (Schema::hasTable('metas')) {
            $metas = Metas::all();
            if ($metas) {
                view()->share('metas', $metas);
            }
        }
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
