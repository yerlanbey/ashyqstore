<?php


namespace App\Services;


use Carbon\Carbon;

class TimeService
{
    public static function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeArray = [];
        $rangeArray = [];
        do
        {
            array_push($timeArray,[
                'start' => $time->format("H:i"),
                'end' => $time->addMinutes(30)->format("H:i")
            ]);
        }while($time->format("H:i") !== $to);

        foreach ($timeArray as $time){
            $timeText = $time['start'] . '-' . $time['end'];
            array_push($rangeArray, $timeText);
        }
        return $rangeArray;
    }
}
