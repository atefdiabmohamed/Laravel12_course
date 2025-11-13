<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WelcomeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'welcome:user {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'call other command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $name=$this->argument('name');
       $this->call('say:hello',['name'=>$name]);
        $this->callSilently('say:hello',['name'=>$name]);
        $this->info("لقد تم تنفيذ كلا الامرين");
       
    }
}
