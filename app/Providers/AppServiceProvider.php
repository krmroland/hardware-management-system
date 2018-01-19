<?php

namespace App\Providers;

use App\Sale;
use Exception;
use App\Purchase;
use App\TransactionDetail;
use App\Observers\SaleObserver;
use Illuminate\Support\Facades\DB;
use App\Observers\PurchaseObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\TransactionDetailObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //TransactionDetail::observe(TransactionDetailObserver::class);
        DB::listen(function ($query) {
            \Log::info($query->sql, $query->bindings);
        });

        $this->app->bind(\App\Client::class, function ($app) {
            try {
                $data = DB::table('clients')->where([
                    'branch_id' => auth()->user()->activeBranch()->id,
                ])->find($app['request']->route('client'));

                return resolve($data->client_type)->fill((array) $data);
            } catch (Exception $e) {
                throw  new Exception('Client Not Found');
            }
        });

        Purchase::observe(PurchaseObserver::class);
        Sale::observe(SaleObserver::class);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
