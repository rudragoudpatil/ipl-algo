<?php

namespace App\Controller;

use App\IndianPremierLeague\FixtureGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IPLController extends AbstractController
{
    public function match(Request $request)
    {
        // Provide opponents in an array format
        $teams = [
            'CHENNAI SUPER KINGS (CSK)',
            'DELHI CAPITALS',
            'KINGS XI PUNJAB (KXIP)',
            'KOLKATA KNIGHT RIDERS (KKR)',
            'MUMBAI INDIANS (MI)',
            'RAJASTHAN ROYALS (RR)',
            'ROYAL CHALLENGERS BANGALORE (RBC)',
            'SUNRISERS HYDERABAD (SRH)'];

        $stadiums = array(
            'CHENNAI SUPER KINGS (CSK)' => 'CHENNAI',
            'DELHI CAPITALS' => 'DELHI',
            'KINGS XI PUNJAB (KXIP)' => 'PUNJAB',
            'KOLKATA KNIGHT RIDERS (KKR)' => 'KOLKATA',
            'MUMBAI INDIANS (MI)' => 'MUMBAI',
            'RAJASTHAN ROYALS (RR)' => 'RAJASTHAN',
            'ROYAL CHALLENGERS BANGALORE (RBC)' => 'BANGALORE',
            'SUNRISERS HYDERABAD (SRH)' => 'HYDERABAD',
        );

        $roundrobin = new FixtureGenerator($teams);

        $roundrobin->createMatches();

        if ($roundrobin->finished) {
            $round = $roundrobin->matches;
        }
        $matches_home = array();
        $matches_away = array();

        foreach ($round as $key => $value) {
            foreach ($value as $k ) {
                $matches_home[] = array(
                    'home_team' => $k[0],
                    'away_team' => $k[1],
                    'stadium'	=> $stadiums[$k[0]]
                );
            }
        }

        foreach ($round as $key => $value) {
            foreach ($value as $k ) {
                $matches_away[] = array(
                    'home_team' => $k[0],
                    'away_team' => $k[1],
                    'stadium'	=> $stadiums[$k[1]]
                );
            }
        }

        $matches = array_merge($matches_home, $matches_away);

        if($request->request->has('tournamentStartDate')){
            $tournamentStartDate = $request->request->get('tournamentStartDate');
        }else{
            $tournamentStartDate = date('Y-m-d');
        }

        $matches = $roundrobin->setDates($matches, $tournamentStartDate);

        return $this->render('ipl/index.html.twig', [
            'matches' => $matches,
            'teams' => $teams,
            'stadiums' => $stadiums,
        ]);
    }
}