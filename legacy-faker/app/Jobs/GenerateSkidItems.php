<?php

namespace App\Jobs;

use App\Models\SkidItem;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Lottery;

class GenerateSkidItems implements ShouldQueue
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
     * 
     * This job will create skid items going back up to 10 days in the past.
     * It will create them at random intervals during the day to simulate
     * real business movement during all hours of the day.
     */
    public function handle(): void
    {
        $this->mostRecent = new Carbon(SkidItem::latest('time')->value('time'));
        $now = now();

        if ( abs($this->mostRecent->diffInDays($now)) > 10 ) {
            $this->mostRecent = (new Carbon())->subDays(10);
        }

        while ($this->mostRecent->lt($now->copy()->subMinute())) {
            $this->randomlyGenerateSkidItem();

            $this->mostRecent->addMinute();
        }

        $this->randomlyGenerateSkidItem();
    }

    /**
     * Will randomly generate a skid item record based on lottery odds.
     */
    private function randomlyGenerateSkidItem() : void
    {
        $create = Lottery::odds(3, 20)->choose();

        if (!$create) return;

        SkidItem::factory()->create([
            'time' => $this->mostRecent
        ]);
    }
}
