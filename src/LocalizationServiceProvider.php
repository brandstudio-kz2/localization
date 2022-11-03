<?php

namespace BrandStudio\Localization;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/localization.php', 'localization');

        if ($this->app->runningInConsole()) {
            $this->publish();
        }

        $this->app->bind('brandstudio_localization',function() {
            return new LocalizationService(config('localization'));
        });

    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config/localization.php' => config_path('localization.php')
        ], 'config');
    }

}
