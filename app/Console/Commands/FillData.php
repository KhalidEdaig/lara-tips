<?php

namespace App\Console\Commands;

use App\Jobs\ProcessFillData;
use Illuminate\Console\Command;

class FillData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill data';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        for ($i=0; $i < 100; $i++) {
            ProcessFillData::dispatch();
        }
       
    }
}
