<?php

namespace App\Listeners;

use App\Events\CourseAddEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CourseAddListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CourseAddEvent $event): void
    {
       DB::table('messages')->insert([
     'message'=>"تم اضافة كورس جديد ياسم ".$event->course,
     'created_at'=>now()
  
       ]);


    }
}
