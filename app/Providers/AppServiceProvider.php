<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use App\Events\CancelOrderCart;
use App\Listeners\SendEmailOnCancelOorder;


use Illuminate\Support\Facades\Event;
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
        //
 RateLimiter::for('lmit5', function (Request $request) {

        return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip());

    });


    Response::macro('caps', function (string $value) {

            return Response::make(strtoupper($value));

        });


            Event::listen(

        CancelOrderCart::class,

        SendEmailOnCancelOorder::class,

    );

    }
}
