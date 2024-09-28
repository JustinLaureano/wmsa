<?php

namespace App\Jobs;

use App\Models\MaterialRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Lottery;

class GenerateMaterialRequests implements ShouldQueue
{
    use Queueable;

    private Carbon $mostRecent;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->mostRecent = new Carbon(MaterialRequest::newest()->first()->created_at);
        $now = now();

        if ( abs($this->mostRecent->diffInDays($now)) > 7 ) {
            $this->mostRecent = (new Carbon())->subDays(7);
        }

        while ($this->mostRecent->lt($now->copy()->subMinute())) {
            $this->randomlyGenerateMaterialRequest();

            $this->mostRecent->addMinute();
        }

        $this->randomlyGenerateMaterialRequest();
    }

    /**
     * Will randomly generate a material request record based on lottery odds.
     */
    private function randomlyGenerateMaterialRequest() : void
    {
        $create = Lottery::odds(1, 7)->choose();

        if (!$create) return;

        $time = $this->mostRecent->format('H:i:') . str_pad( strval(rand(1, 59)), 2, '0', STR_PAD_LEFT);

        MaterialRequest::factory()->create([
            'date' => $this->mostRecent->toDateString(),
            'time' => $time,
            'last_activity' => $this->mostRecent->toDateString() .' '. $time
        ]);
    }
}
