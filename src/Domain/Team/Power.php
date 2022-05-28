<?php

namespace App\Domain\Team;

class Power
{
    const MIN_POWER_ALLOWED = 0;
    const MAX_POWER_ALLOWED = 80;

    /**
     * @throws PowerValueNotAllowed
     */
    public function __construct(readonly int $value)
    {
        $this->guard();
    }

    /**
     * @throws PowerValueNotAllowed
     */
    private function guard(): void
    {
        if ($this->value < self::MIN_POWER_ALLOWED || $this->value > self::MAX_POWER_ALLOWED) {
            throw PowerValueNotAllowed::create($this->value);
        }
    }
}