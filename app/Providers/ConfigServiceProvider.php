<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use App\Models\BusinessSetting;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $pagination = BusinessSetting::where(['type' => 'default_pagination'])->first();
            if ($pagination) {
                Config::set('default_pagination', $pagination->value);
            } else {
                Config::set('default_pagination', 25);
            }
        } catch (\Exception $ex) {

        }
    }
}
