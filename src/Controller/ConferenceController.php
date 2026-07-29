<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        $greet = '';
        if ($name = $request->query->get('name')) {
            $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        }
        dump($request);
        $method = $request->getMethod();
        return new Response(<<<EOF
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Welcome!</title>
                </head>
                <body>
                    $greet
                    <p>Request method: $method</p>
                    <img src="/images/under-construction.gif" />
                </body>
            </html>
        EOF);
    }
}
