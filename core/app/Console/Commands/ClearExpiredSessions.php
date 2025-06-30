<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearExpiredSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all sessions from the sessions table that are older than the session lifetime.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the session lifetime from config (in minutes)
        $sessionLifetime = config('session.lifetime', 120);

        // Calculate the timestamp for expired sessions
        $expirationThreshold = Carbon::now()->subMinutes($sessionLifetime)->getTimestamp();

        // Delete sessions where last_activity is older than the threshold
        $deletedRows = DB::table('sessions')
            ->where('last_activity', '<', $expirationThreshold)
            ->delete();

        // Output the result
        $this->info("Cleared {$deletedRows} expired session(s) from the sessions table.");

        return 0;
    }
}
