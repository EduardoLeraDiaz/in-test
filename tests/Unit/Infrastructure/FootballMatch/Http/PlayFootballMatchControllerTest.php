<?php

namespace App\Tests\Unit\Infrastructure\FootballMatch\Http;

use App\Application\FootballMatch\UseCase\PlayFootballMatchResult;
use App\Application\FootballMatch\UseCase\PlayFootballMatchUseCase;
use App\Domain\FootballMatch\PlayedFootballMatch;
use App\Domain\Team\Power;
use App\Domain\Team\Team;
use App\Infrastructure\FootballMatch\Http\PlayFootballMatchController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class PlayFootballMatchControllerTest extends TestCase
{
    private $playFootbalMatchUseCase;
    private PlayFootballMatchController $sut;

    protected function setUp(): void
    {
        $this->playFootbalMatchUseCase = $this->createMock(PlayFootballMatchUseCase::class);
        $this->sut = new PlayFootballMatchController($this->playFootbalMatchUseCase);
    }

    public function testItCallsTheUseCaseAndReturnTheResult()
    {
        $request = new Request([], $this->getCorrectRequestBody());

        $result = new PlayFootballMatchResult($this->getPlayedFootballMatch());

        $this->playFootbalMatchUseCase
            ->expects($this->once())
            ->method('__invoke')
            ->willReturn($result);

        $response = ($this->sut)($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            '{"home":{"team":"Liverpool","goals":2},"visitor":{"team":"Man. United","goals":2}}',
            $response->getContent()
        );
    }

    public function testTheReponseErrorPowerOfATeamIsToHigh()
    {
        $body = $this->getCorrectRequestBody();
        $body['home']['power'] = 10000000;

        $response = ($this->sut)(new Request([], $body));

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals(
            '{"error":"Power value 10000000 is not allowed"}',
            $response->getContent()
        );
    }

    private function getCorrectRequestBody(): array
    {
        return  [
            'home' => [
                'name' => 'Liverpool',
                'power' => 80
            ],
            'visitor' => [
                'name' => 'Man. United',
                'power' => 80
            ],
        ];
    }

    private function getPlayedFootballMatch(): PlayedFootballMatch
    {
        return new PlayedFootballMatch(
            new Team('Liverpool', new Power(80)),
            new Team('Man. United', new Power(80)),
            2,
            2
        );
    }
}
