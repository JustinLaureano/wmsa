<?php

namespace App\Support;

use App\Exception\LotNumberException;
use Carbon\Carbon;

class LotNumber
{
    private $day;
    private $month;
    private $year;
    private $shift;
    private $shiftEndHour;
    private $lotNumber = null;
    private $timestamp = null;

    public function __construct(string $lotNumber = null)
    {
        $this->lotNumber = trim($lotNumber) ? trim($lotNumber) : $this->instantiate();

        $regex = "/\d{6}[A,a,B,b,C,c,D,d,P,p,0-9,RW,G,g,X,x][T,t,Q,q,J,j]?/";

        if (!preg_match($regex, $this->lotNumber)) {
            throw new LotNumberException('Invalid Lot Number - ' . $lotNumber);
        }

        $this->parse();
    }

    /**
     * Create a lot number based on the current date and time
     *
     * @return string
     */
    private function instantiate()
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
     * date and shift parts of the number
     *
     * @return void
     */
    private function parse()
    {
        $this->month = substr($this->lotNumber, 0, 2);
        $this->day = substr($this->lotNumber, 2, 2);
        $this->year = '20'.substr($this->lotNumber, 4, 2);
        $this->shift = strtoupper(substr($this->lotNumber, -1));

        switch ($this->shift) {
            case 'A':
            case 'X':
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
     * Return the lot number month value
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Return the lot number day value
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Return the lot number year value
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Return the lot number shift value
     *
     * @return string
     */
    public function getShift()
    {
        return $this->shift;
    }

    /**
     * Create a time stamp using the lot number date values
     *
     * @return string
     */
    public function toTimeStamp()
    {
        if (!$this->timestamp) {
            $this->timestamp = Carbon::create($this->year, $this->month, $this->day);

            $this->timestamp->setTime($this->shiftEndHour, 0, 0);
        }

        return $this->timestamp;
    }

    /**
     * Create a date string using the lot number date values
     *
     * @return string
     */
    public function toDateString()
    {
        $date = Carbon::create($this->year, $this->month, $this->day);

        return $date->toDateString();
    }

    /**
     * Create a date string for tomorrow's date using the lot number date values
     *
     * @return string
     */
    public function toTomorrowDateString()
    {
        $date = Carbon::create($this->year, $this->month, $this->day);

        return $date->addDay()->toDateString();
    }

    /**
     * @param string|null $lotNumber
     *
     * @return string
     *
     * @throws LotNumberException
     */
    public static function lotToTimestamp(string $lotNumber = null)
    {
        return (new static($lotNumber))->toTimeStamp();
    }
}
