<?php

namespace App\Domain\FootballMatch;

use App\Domain\Team\Team;

class PlayedFootballMatch extends FootballMatch
{
    public function __construct(Team $home, Team $visitor, readonly int $goalsHome, readonly int $goalsVisitor)
    {
        parent::__construct($home, $visitor);
    }
}
