<?php

namespace App\Support\Enums;

enum TimeToLiveEnum: int
{
    case THIRTY_SECONDS = 30;
    case ONE_MINUTE = 60;
    case TWO_MINUTES = 120;
    case FIVE_MINUTES = 300;
    case TEN_MINUTES = 600;
    case FIFTEEN_MINUTES = 900;
    case THIRTY_MINUTES = 1800;
    case ONE_HOUR = 3600;
    case TWO_HOURS = 7200;
    case FOUR_HOURS = 14400;
    case EIGHT_HOURS = 28800;
    case TWELVE_HOURS = 43200;
    case ONE_DAY = 86400;
    case TWO_DAYS = 172800;
    case THREE_DAYS = 259200;
    case ONE_WEEK = 604800;
    case ONE_MONTH = 2592000;
    case ONE_YEAR = 31536000;
}
