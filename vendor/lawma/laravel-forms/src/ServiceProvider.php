<?php

namespace Lawma\Forms;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'forms');

        $this->publishes([
               __DIR__.'/resources/views' => resource_path('views/vendor/forms'),
           ], 'forms');
    }

    public function register()
    {
        $this->app->bind('lawma-form', function ($app) {
            return new Form();
        });
    }
}
