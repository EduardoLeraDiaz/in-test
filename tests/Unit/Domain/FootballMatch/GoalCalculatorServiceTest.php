<?php

namespace App\Tests\Unit\Domain\FootballMatch;

use App\Domain\FootballMatch\GoalCalculatorService;
use PHPUnit\Framework\TestCase;

class GoalCalculatorServiceTest extends TestCase
{
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new GoalCalculatorService();
    }

    /**
     * @dataProvider getPowerDifferenceDataProvider
     */
    public function testCalculate(int $powerDifference): void
    {
        $result = $this->sut->calculate($powerDifference);
        $this->assertGreaterThanOrEqual(0, $result, 'Goals can be a negative number');
    }

    public function getPowerDifferenceDataProvider(): array
    {
        return array_map(
            function ($val) {return [$val];},
            array_values(range(-40,40, 5))
        );
    }
}
