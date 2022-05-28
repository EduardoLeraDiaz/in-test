<?php

namespace App\Domain\Team;

class Team
{
    public function __construct(readonly string $name, readonly Power $power) {}
}