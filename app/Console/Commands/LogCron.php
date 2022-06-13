<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Integrations\SpaceDevs;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set("America/Sao_Paulo");
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");
        //$spaceDev = new SpaceDevs();
       //for ($page = 0; $page < 2000; $page+100) {
            //$aux = $spaceDev->teste(200);
            print_r('aaa');
       //}
    }
}
