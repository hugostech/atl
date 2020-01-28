<?php

namespace App\Console\Commands;

use App\Libs\Reminder;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check vehicles infos, send users reminder email';

    /**
     *
     * Vehicle reminder generator
     *
     * @var Reminder
     */
//    protected $reminder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

//        $this->reminder = new Reminder();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminder = new Reminder();
        $ruc = $reminder->getNeedRucCars();
        $cof = $reminder->getNeedCofCars();
        $service = $reminder->getNeedServiceCars();
        $reg = $reminder->getNeedRegCars();
    }
}
