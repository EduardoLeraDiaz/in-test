<?php

namespace App\Domain\Team;

class Power
{
    const MIN_POWER_ALLOWED = 0;
    const MAX_POWER_ALLOWED = 80;

    /**
     * @throws PowerValueNotAllowedException
     */
    public function __construct(readonly int $value)
    {
        $this->guard();
    }

    /**
     * @throws PowerValueNotAllowedException
     */
    private function guard(): void
    {
        if ($this->value < self::MIN_POWER_ALLOWED || $this->value > self::MAX_POWER_ALLOWED) {
            throw PowerValueNotAllowedException::create($this->value);
        }
    }
}