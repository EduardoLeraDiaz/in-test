<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{
    public function __invoke()
    {
        return new Response('Hello World');
    }
}