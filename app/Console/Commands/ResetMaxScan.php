<?php

namespace App\Console\Commands;

use App\Models\Merchant;
use Illuminate\Console\Command;

class ResetMaxScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resetmaxscan:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Max Scan per Hari';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Merchant::query()->update(['max_scan' => 0]);
    }
}