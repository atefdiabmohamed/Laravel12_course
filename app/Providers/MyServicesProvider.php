<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // تسجيل الخدمات بيتم هنا
     $this->app->singleton('atefhi',function(){
    return new \App\Services\HelperService;

        
     });


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // تنفيذ اي شيء اخر بعد التسجيل 
    }
}
