<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:hello {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'عرض رسالة ترحيبية فقط';

    /**
     * Execute the console command.
     */
    public function handle()
    {
     $name=$this->argument('name'); 
     $this->info("Welcome {$name}" );  

    }
}
