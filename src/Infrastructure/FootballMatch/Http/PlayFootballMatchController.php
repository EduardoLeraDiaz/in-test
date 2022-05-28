<?php

namespace App\Infrastructure\FootballMatch\Http;

use App\Application\FootballMatch\UseCase\PlayFootballMatchRequest;
use App\Application\FootballMatch\UseCase\PlayFootballMatchUseCase;
use App\Domain\FootballMatch\FootballMatch;
use App\Domain\Team\Power;
use App\Domain\Team\PowerValueNotAllowedException;
use App\Domain\Team\Team;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayFootballMatchController
{
    const BAD_REQUEST_MESSAGE = 'Request needs a home and a visitor with name and power';
    const POWER_NOT_NUMERIC_MESSAGE = 'Power has to be a number';

    /** TODO: Use a command bus instead of instantiate directly the use cases */
    public function __construct(private PlayFootballMatchUseCase $useCase)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
           $footballMatch = $this->parseAndValidateRequest($request);
        } catch(BadRequestHttpException|PowerValueNotAllowedException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST );
        }

        $result = ($this->useCase)(new PlayFootballMatchRequest($footballMatch));

        return new JsonResponse($result->getResult());
    }

    /** TODO: Use the serializar to get the FootballMatch from the request */
    private function parseAndValidateRequest(Request $request): FootballMatch
    {
        $home = $request->get('home');
        $visitor = $request->get('visitor');

        if (!is_array($home) || !is_array($visitor)) {
            throw new BadRequestHttpException(self::BAD_REQUEST_MESSAGE);
        }

        return new FootballMatch(
            new Team(
                $home['name'] ?? throw new BadRequestHttpException(self::BAD_REQUEST_MESSAGE),
                $this->parseAndValidatePower($home['power'])
            ),
            new Team(
                $visitor['name'] ?? throw new BadRequestHttpException(self::BAD_REQUEST_MESSAGE),
                $this->parseAndValidatePower($visitor['power'])
            )            
        );
    }

    private function parseAndValidatePower($power): Power
    {
        if (!is_numeric($power)) {
            throw new BadRequestHttpException(self::POWER_NOT_NUMERIC_MESSAGE);
        }

        return new Power((int) $power);
    }
}
