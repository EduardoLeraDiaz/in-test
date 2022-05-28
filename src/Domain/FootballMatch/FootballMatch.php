<?php

namespace App\Domain\FootballMatch;

# A class can be called Match as it is a reserved words for that version of PHP so we use that name
use App\Domain\Team\Team;

class FootballMatch
{
    public function __construct(readonly Team $home, readonly Team $visitor){}
}