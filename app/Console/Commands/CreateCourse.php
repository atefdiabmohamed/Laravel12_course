<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Courses;
class CreateCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //اسم الامر اللي حستدعيه في التريمنال
    protected $signature = 'course:create{coursename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new course in table';

    /**
     * Execute the console command.
     */
    public function handle()
    {

   $coursename=$this->argument('coursename');     
    Courses::create(['name'=>$coursename]);  
    dump("the course called $coursename created !");


    }
}
