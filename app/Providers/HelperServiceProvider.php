<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $Config = app_path('Helpers/Config.php');
        $Prod = app_path('Helpers/Prod.php');
        $Rub = app_path('Helpers/Rub.php');

        if (file_exists($Config)) {
            require_once($Config);
        }

        if (file_exists($Prod)) {
            require_once($Prod);
        }

        if (file_exists($Rub)) {
            require_once($Rub);
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
