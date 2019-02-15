<?php
/**
 * Created by PhpStorm.
 * User: techjini
 * Date: 15/2/19
 * Time: 11:30 PM
 */

namespace App\IndianPremierLeague;


class TeamConstant
{
    const TEAM_ONE = 1;
    const TEAM_TWO = 2;
    const TEAM_THREE = 3;
    const TEAM_FOUR = 4;
    const TEAM_FIVE = 5;
    const TEAM_SIX = 6;
    const TEAM_SEVEN = 7;
    const TEAM_EIGHT = 8;

    public static $team = [
        self::TEAM_ONE => 'CHENNAI SUPER KINGS (CSK)',
        self::TEAM_TWO => 'DELHI CAPITALS',
        self::TEAM_THREE => 'KINGS XI PUNJAB (KXIP)',
        self::TEAM_FOUR => 'KOLKATA KNIGHT RIDERS (KKR)',
        self::TEAM_FIVE => 'MUMBAI INDIANS (MI)',
        self::TEAM_SIX => 'RAJASTHAN ROYALS (RR)',
        self::TEAM_SEVEN => 'ROYAL CHALLENGERS BANGALORE (RBC)',
        self::TEAM_EIGHT => 'SUNRISERS HYDERABAD (SRH)'
    ];

    public static $homeGrounds = [
        self::TEAM_ONE => 'CHENNAI',
        self::TEAM_TWO => 'DELHI',
        self::TEAM_THREE => 'PUNJAB',
        self::TEAM_FOUR => 'KOLKATA',
        self::TEAM_FIVE => 'MUMBAI',
        self::TEAM_SIX => 'RAJASTHAN',
        self::TEAM_SEVEN => 'BANGALORE',
        self::TEAM_EIGHT => 'HYDERABAD'
    ];
}