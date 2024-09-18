<?php

namespace App\Domain\Materials\Support;

use Carbon\Carbon;
use Exception;

class LotNumber
{
    private string $day;
    private string $month;
    private string $year;
    private string $shift;
    private int $shiftEndHour;
    private Carbon|false|null $timestamp = null;

    /**
     * Instantiate a model instance.
     */
    public function __construct(private string|null $lotNumber = null)
    {
        $this->lotNumber = trim($lotNumber) ? trim($lotNumber) : $this->instantiate();

        $regex = "/\d{6}[A,a,B,b,C,c,D,d,P,p,0-9,RW,G,g][T,t,Q,q,J,j]?/";

        if ( !preg_match($regex, $this->lotNumber) ) {
            throw new Exception('Invalid Lot Number - ' . $lotNumber);
        }

        $this->parse();
    }

    /**
     * Create a lot number based on the current date and time.
     */
    private function instantiate() : string
    {
        $today = (new Carbon());
        $hour = (new Carbon())->hour;
        $minute = (new Carbon())->minute;

        if ($hour >= 23) {
            $today->addDay();
            $currentShift = 'C';
        }
        else if ($hour < 7 || ($hour == 7 && $minute < 15) ) {
            $currentShift = 'C';
        }
        else if ($hour > 7 && $hour <= 15) {
            $currentShift = $hour == 15 && $minute >=15 ? 'B' : 'A';
        }
        else {
            $currentShift = 'B';
        }

        return $today->format('mdy').$currentShift;
    }

    /**
     * Parse the lot number to determine the different
     * date and shift parts of the number.
     */
    private function parse() : void
    {
        $this->month = substr($this->lotNumber, 0, 2);
        $this->day = substr($this->lotNumber, 2, 2);
        $this->year = '20'.substr($this->lotNumber, 4, 2);
        $this->shift = strtoupper(substr($this->lotNumber, -1));

        switch ($this->shift) {
            case 'A':
            case 1:
                $this->shiftEndHour = 15;
                break;
            case 'B':
            case 2:
                $this->shiftEndHour = 23;
                break;
            case 'C':
            case 3:
                $this->shiftEndHour = 7;
                break;
            case 'P':
                $this->shiftEndHour = 19;
                break;
            default:
                $this->shiftEndHour = 12;
        }
    }

    /**
     * Return the lot number month value.
     */
    public function getMonth() : string
    {
        return $this->month;
    }

    /**
     * Return the lot number day value.
     */
    public function getDay() : string
    {
        return $this->day;
    }

    /**
     * Return the lot number year value.
     */
    public function getYear() : string
    {
        return $this->year;
    }

    /**
     * Return the lot number shift value.
     */
    public function getShift() : string
    {
        return $this->shift;
    }

    /**
     * Create a time stamp using the lot number date values.
     */
    public function toTimeStamp() : string
    {
        if (!$this->timestamp) {
            $this->timestamp = Carbon::create($this->year, $this->month, $this->day);

            $this->timestamp->setTime($this->shiftEndHour, 0, 0);
        }

        return $this->timestamp;
    }

    /**
     * Create a date string using the lot number date values.
     */
    public function toDateString() : string
    {
        $date = Carbon::create($this->year, $this->month, $this->day);

        return $date->toDateString();
    }

    /**
     * Create a date string for tomorrow's date using the lot number date values.
     */
    public function toTomorrowDateString() : string
    {
        $date = Carbon::create($this->year, $this->month, $this->day);

        return $date->addDay()->toDateString();
    }
}
