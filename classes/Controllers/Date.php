<?php

namespace Controller;

use Carbon\Carbon;


class Date
{
    public static function convertFromJsToHuman($date)
    {
        return Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $date)->toDateTimeString(); // 1975-05-21 22:00:00

    }

    public static function convertFromHumanToJs($date)
    {
        return Carbon::createFromTimestampMsUTC($date)->format('Y-m-d\TH:i:s.uP'); // 1970-01-01T00:00:00.001000+00:00
    }

    public static function checkIfIsAtrasado($date)
    {
        $now = Carbon::now();
        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $date);

        return $date->lessThan($now);
    }

    public static function jsNow()
    {
        $now = Carbon::now();
        return $now->format('Y-m-d\TH:i:s.uP');
    }
}
