<?php

namespace App\Infrastructure\Shared\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class HealthcheckController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['api' => 'ok']);
    }
}
