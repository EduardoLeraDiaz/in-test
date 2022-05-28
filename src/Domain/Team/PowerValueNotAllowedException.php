<?php

namespace App\Domain\Team;

class PowerValueNotAllowedException extends \Exception
{
    public const MESSAGE = 'Power value %d is not allowed';

    public static function create(int $power)
    {
        return new self(sprintf(self::MESSAGE, $power));
    }
}
