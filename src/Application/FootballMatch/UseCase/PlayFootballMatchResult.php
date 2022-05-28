<?php

namespace App\Application\FootballMatch\UseCase;

use App\Domain\FootballMatch\PlayedFootballMatch;

class PlayFootballMatchResult
{
    public function __construct(readonly PlayedFootballMatch $match)
    {
    }

    public function getResult(): array
    {
        return [
            'home' => [
              'team' => $this->match->home->name,
              'goals' => $this->match->goalsHome,
            ],
            'visitor' => [
                'team' => $this->match->visitor->name,
                'goals' => $this->match->goalsVisitor
            ],
        ];
    }
}