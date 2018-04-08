<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Session;

class DeletePassedSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agora:deletePassedSessions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete passed sessions';

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
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now()->toDateTimeString();

        Session::where('end_at', '<', $currentDate)->delete();
    }
}
