<?php

namespace App\Domain\FootballMatch;

class GoalCalculatorService
{
    /** TODO: Find a better way to calculate that */
    public function calculate(int $powerDifference): int
    {
        $chancesToMakeFirstGoal = max(min(50 + $powerDifference / 2, 80), 20);
        return $this->calculateGoals($chancesToMakeFirstGoal);
    }

    private function calculateGoals(float $chances, $goals=0)
    {
        if( rand(0,100) <= $chances ) {
            return $this->calculateGoals(max(floor($chances * 0.66), 1), ++$goals);
        }

        return $goals;
    }
}
