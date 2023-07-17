<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class CalendarHelper
{
    public static function getCountWeekendInPeriod(string $date, string $format, int $length): int
    {
        $startDate = Carbon::createFromFormat($format, $date);
        $endDate   = Carbon::parse($startDate)->addDays($length);;
        return Carbon::parse($startDate)->diffInWeekendDays(Carbon::parse($endDate));
    }
}
