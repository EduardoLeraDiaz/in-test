<?php

namespace App\Application\FootballMatch\UseCase;

use App\Domain\FootballMatch\GoalCalculatorService;
use App\Domain\FootballMatch\PlayedFootballMatch;

class PlayFootballMatchUseCase
{
    const POWER_ADDED_TO_HOME = 20;

    public function __construct(private GoalCalculatorService $goalCalculatorService)
    {
    }

    public function __invoke(PlayFootballMatchRequest $request): PlayFootballMatchResult
    {
        $homePower = $request->homePower() + self::POWER_ADDED_TO_HOME;
        $visitorPower = $request->visitorPower();

        return new PlayFootballMatchResult(
            new PlayedFootballMatch(
                $request->footballMatch->home,
                $request->footballMatch->visitor,
                $this->goalCalculatorService->calculate($homePower - $visitorPower),
                $this->goalCalculatorService->calculate($visitorPower - $homePower)
            )
        );
    }
}