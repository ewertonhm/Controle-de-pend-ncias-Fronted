<?php

namespace Controller;

use Carbon\Carbon;


class Date
{
    public static function convertFromJsToHuman($date)
    {
        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $date);
        $date->setTimezone('America/Sao_Paulo');
        //dump($date);

        return $date->toDateTimeString(); // 1975-05-21 22:00:00;
    }

    public static function convertFromJsToHumanPluOne($date)
    {
        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $date);
        $date->setTimezone('America/Sao_Paulo');
        $date->addHour(1);
        //dump($date);

        return $date->toDateTimeString(); // 1975-05-21 22:00:00;
    }

    public static function convertFromHumanToJs($date)
    {
        $date = Carbon::parse($date);
        $date->setTimezone('America/Sao_Paulo');

        return $date->format('Y-m-d\TH:i:s.uP'); // 1970-01-01T00:00:00.001000+00:00
    }

    public static function checkIfIsAtrasado($date)
    {
        $now = Carbon::now('America/Sao_Paulo');

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $date);
        $date->setTimezone('America/Sao_Paulo');

        return $date->lessThan($now);
    }

    public static function jsNow()
    {
        $now = Carbon::now();
        return $now->format('Y-m-d\TH:i:s.uP');
    }



    public static function convertFromHtmlToJS($dateFromBSForm)
    {
        $date = Carbon::parse($dateFromBSForm);
        $date->setTimezone('America/Sao_Paulo');
        return $date->format('Y-m-d\TH:i:s.uP');
    }
}
