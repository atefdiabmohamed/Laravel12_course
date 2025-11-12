<?php

namespace App\Listeners;

use App\Events\CourseAddEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
class CourseAddListener  implements ShouldQueue
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

        public $delay = 10;
}
