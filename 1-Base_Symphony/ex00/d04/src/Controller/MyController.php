<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyController
{
    #[Route('/e00/firstpage')]
    public function firstpage(): Response
    {
        return new Response('Hello world!');
    }
}