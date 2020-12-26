<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebTokenAction extends AbstractController
{
    /**
     * @Route("/token")
     */
    public function __invoke(): Response
    {
        return new Response('token');
    }
}
