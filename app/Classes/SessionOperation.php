<?php


namespace App\Classes;


class SessionOperation
{

    private $totSessionsNumRequired;
    private $totWeeksNumRequired;
    private $available_days_per_week;

    public function mapping_weekly_days()
    {

        return [
            'saturday' => 1,
            'sunday' => 2,
            'monday' => 3,
            'tuesday' => 4,
            'wednesday' => 5,
            'thursday' => 6,
            'friday' => 7,
        ];
    }

    public function calSessnumsFinishingChapters($request, $chapters_count = 30)
    {
        $maximum_sessnum_onlychapter = $request['finishing_session_num'];
        $this->totSessionsNumRequired = $maximum_sessnum_onlychapter * $chapters_count;
        return $this;
    }

    public function calWeeksnumsFinishingSessions()
    {
        $this->available_days_per_week = request()->input('available_days_per_week');
        $available_days_per_week_count = count($this->available_days_per_week);
        $this->totWeeksNumRequired = $this->totSessionsNumRequired / $available_days_per_week_count;
        return $this;
    }

    public function loopingInsideWeeksSessions(){
         $available_days_per_week = $this->available_days_per_week;
         sort($available_days_per_week);
         $weeks_num = $this->totWeeksNumRequired;
         $available_days_per_week_count = count($available_days_per_week);
         // loop inside weeks
         $i=0;
         $items = array();
         $Date = request()->input('sessions_start_date');
         while ($i < $weeks_num){

             // loop inside days every week
             $i1=0;

             while ($i1 < $available_days_per_week_count){
                if(($i1+1) < $available_days_per_week_count || $i1 == 0) {
                     $date_diff = $available_days_per_week[$i1 + 1] - $available_days_per_week[$i1];
                 }

                 $Date = date('Y-m-d', strtotime($Date. ' + '.$date_diff.' days'));
                  array_push($items,$Date);

                 $i1++;
             }
             $i++;
         }
         return $items;
    }



}
