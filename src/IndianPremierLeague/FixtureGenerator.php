<?php

namespace App\IndianPremierLeague;

class FixtureGenerator
{
    public $finished;
    public $matchdayCount;
    private $teams;
    private $teams1;
    private $teams2;
    public $matches;

    public function __construct($passedTeams = null) {
        $this->teams = $passedTeams;
        $this->finished = false;
        $this->matchdayCount = 0;
        $this->matches = array();
    }

    public function createMatches() {
        $this->matches = array();
        $this->teams1 = array_slice($this->teams, 0, ceil(count($this->teams)/2));
        $this->teams2 = array_slice($this->teams, ceil(count($this->teams)/2));

        if (!$this->matchdayCount) {
            for ($i = 2; $i < (count($this->teams1) * 2); $i++){
                $this->saveMatchday();
                $this->rotate();
            }
            $this->saveMatchday();
        }

        $this->finished = true;

        return $this->matches;
    }

    private function saveMatchday() {
        for ($i = 0; $i < count($this->teams1); $i++) {
                $matches_tmp[] = array($this->teams1[$i], $this->teams2[$i]);
        }
        $this->matches[] = $matches_tmp;
        return true;
    }

    private function rotate() {
        $temp = $this->teams1[1];
        for($i = 1; $i < (count($this->teams1) - 1); $i++) {
            $this->teams1[$i] = $this->teams1[$i + 1];
        }
        $this->teams1[count($this->teams1) - 1] = end($this->teams2);
        for($i = (count($this->teams2) - 1); $i > 0; $i--) {
            $this->teams2[$i] = $this->teams2[$i - 1];
        }
        $this->teams2[0] = $temp;
        return true;
    }

    public function setDates($schedule, $startingDate) {

        $date = $startingDate;
        $schedule[0]['date'] = $date;

        $weekendCount = 0;
        for ($i=1; $i < count($schedule); $i++) {

            (!$this->isWeekend($date)) ? $date = date('Y-m-d', strtotime('+1 day', strtotime($date))) : $weekendCount++ ;

            if($weekendCount == 2) {
                $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
                $weekendCount =  0;
            }
            $schedule[$i]['date'] = $date;
        }

        return $schedule;

    }

    private function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

}