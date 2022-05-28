<?php

namespace App\Application\FootballMatch\UseCase;

use App\Domain\FootballMatch\FootballMatch;

class PlayFootballMatchRequest
{
    public function __construct(readonly FootballMatch $footballMatch)
    {
    }

    public function homePower(): int
    {
        return $this->footballMatch->home->power->value;
    }

    public function visitorPower(): int
    {
        return $this->footballMatch->visitor->power->value;
    }
}
