<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use App\Models\TaskLog;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    DB::table('notifications')->delete();  
    TaskLog::create([
        'message'=>'تم تنفيذ المهمه الساعة '.now()
    ]);  
})->everyFiveMinutes();







