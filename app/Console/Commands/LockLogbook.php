<?php

namespace App\Console\Commands;

use App\Models\Logbook;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LockLogbook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logbook:lock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lock logbooks older than 24 hours, disabling edit and delete actions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Untuk testing, gunakan 2 menit
        $cutoffTime = Carbon::now()->subMinutes(2);
        
        // Untuk produksi, gunakan 24 jam
        // $cutoffTime = Carbon::now()->subHours(24);

        
        $affected = Logbook::where('created_at', '<', $cutoffTime)
            ->where('is_locked', false)
            ->update(['is_locked' => true]);
            
        $this->info("Locked {$affected} logbook entries older than the cutoff time.");
        
        return Command::SUCCESS;
    }
}